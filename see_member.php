<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'PHP_Animashaun/HeadPartHtml.php'?>
    <?php
    include 'PHP_Animashaun/database.php';

    $entry = true;

    if (isset($_POST['firstname'])) {$firstname = $_POST['firstname_kn'];} else {$entry = false;}
    if (isset($_POST['lastname'])) {$lastname = $_POST['lastname'];} else {$entry = false;}
    if (isset($_POST['gym_member_id'])) {$gym_member_id = $_POST['gym_member_id'];} else {$entry = false;}
    if (isset($_POST['membership_duration'])) {$membership_duration = $_POST['membership_duration'];} else {$entry = false;}
    if (isset($_POST['membership_location'])) {$membership_location = $_POST['membership_location'];} else {$entry = false;}

    if ($entry) {
        $conn = new mysqli($server, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Use prepared statements to avoid SQL injection
        $stmt = $conn->prepare("INSERT INTO gym_member(firstname, lastname, gym_member_id, membership_duration, membership_location) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstname, $lastname, $gym_member_id, $membership_duration, $membership_location);

        try {
            $stmt->execute();
            echo '<script>alert("New Member added successfully.");</script>';
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) {
                // Duplicate entry error code
                echo '<script>alert("GYM ID already exists. Please input a different ID."); window.location.href = "add_member.php";</script>';

            } else {
                // Handle other database errors
                echo '<script>alert("Error adding New Member. Please try again.");</script>';
            }
        }

        // Close the connection
        $stmt->close();
    }

    // Delete operation
    $delete = true;
    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        $conn = new mysqli($server, $username, $password, $database);
        $query = "DELETE FROM gym_member WHERE id='".$id."'";
        $conn->query($query);
        $conn->close();
    }
    
    include 'PHP_Animashaun/ResultMember.php';
    ?>
</head>
<body>
    <?php include 'PHP_Animashaun/header.php'?>
    <?php include 'PHP_Animashaun/article.php'?>
    <h3>Total GYM Member : <?php echo $num?></h3>

    <!-- Display the table -->
    <table border="1">
        <tr>
            <th>id</th><th>Firstname</th><th>Lastname</th><th>GYM ID</th>
            <th>Membership DUration (Month)</th><th>Membership Locations</th>
        </tr>
        <?php include 'PHP_Animashaun/TableMember.php'?>
    </table>

    <!-- Form for updating student data -->
    <form action="update_member.php" method="POST">
        <select name="update_id">
            <?php
            $i = 0;
            while ($i < $num) {
                $rs->data_seek($i);
                $row = $rs->fetch_assoc();
                $option = "<option value=".$row["id"].">";
                $option .= $row["firstname"].'-';
                $option .= $row["lastname"].'-';
                $option .= $row["gym_member_id"].'-';
                $option .= $row["membership_duration"].'-';
                $option .= $row["membership_location"];
                $option .= "</option>";
                echo $option;
                $i++;
            }
            ?>
        </select>

        <table>
            <tr><td>Update GYM Member Data</td></tr>
            <tr><td>Firstname</td><td><input type="text" name="updated_firstname"></td></tr>
            <tr><td>Student Lastname</td><td><input type="text" name="updated_lastname"></td></tr>
            <tr><td>Student ID</td><td><input type="text" name="updated_gym_member_id"></td></tr>
            <tr><td>Year of Study</td><td><input type="text" name="updated_membership_duration"></td></tr>
            <tr><td>Birth Place Location</td><td><input type="text" name="updated_membership_location"></td></tr>
        </table>
        
        <input type="submit" value="Update">
    </form>

    <?php include 'PHP_Animashaun/nav.php'?>
    <?php include 'PHP_Animashaun/footer.php'?>
</body>
</html>