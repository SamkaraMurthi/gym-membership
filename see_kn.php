<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'PHP_Narayana/HeadPartHtml.php'?>
    <?php
    include 'PHP_Narayana/database.php';

    $entry = true;

    if (isset($_POST['firstname_kn'])) {$firstname_kn = $_POST['firstname_kn'];} else {$entry = false;}
    if (isset($_POST['lastname_kn'])) {$lastname_kn = $_POST['lastname_kn'];} else {$entry = false;}
    if (isset($_POST['studentid_kn'])) {$studentid_kn = $_POST['studentid_kn'];} else {$entry = false;}
    if (isset($_POST['yearofstudy_kn'])) {$yearofstudy_kn = $_POST['yearofstudy_kn'];} else {$entry = false;}
    if (isset($_POST['birthplace_kn'])) {$birthplace_kn = $_POST['birthplace_kn'];} else {$entry = false;}

    if ($entry) {
        $conn = new mysqli($server, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Use prepared statements to avoid SQL injection
        $stmt = $conn->prepare("INSERT INTO studentdata_kn(firstname_kn, lastname_kn, studentid_kn, yearofstudy_kn, birthplace_kn) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstname_kn, $lastname_kn, $studentid_kn, $yearofstudy_kn, $birthplace_kn);

        try {
            $stmt->execute();
            echo '<script>alert("Data added successfully.");</script>';
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) {
                // Duplicate entry error code
                echo '<script>alert("Student ID already exists. Please choose a different ID."); window.location.href = "add_kn.php";</script>';

            } else {
                // Handle other database errors
                echo '<script>alert("Error adding data. Please try again.");</script>';
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
        $query = "DELETE FROM studentdata_kn WHERE id='".$id."'";
        $conn->query($query);
        $conn->close();
    }
    
    include 'PHP_Narayana/ResultProductKN.php';
    ?>
</head>
<body>
    <?php include 'PHP_Narayana/header.php'?>
    <?php include 'PHP_Narayana/article.php'?>
    <h3>Total Number of Student : <?php echo $num?></h3>

    <!-- Display the table -->
    <table border="1">
        <tr>
            <th>id</th><th>Student Firstname</th><th>Student Lastname</th><th>Student ID</th>
            <th>Year of Study</th><th>Birth of birth locations</th>
        </tr>
        <?php include 'PHP_Narayana/tableproductsKN.php'?>
    </table>

    <!-- Form for updating student data -->
    <form action="update_kn.php" method="POST">
        <select name="update_id">
            <?php
            $i = 0;
            while ($i < $num) {
                $rs->data_seek($i);
                $row = $rs->fetch_assoc();
                $option = "<option value=".$row["id"].">";
                $option .= $row["firstname_kn"].'-';
                $option .= $row["lastname_kn"].'-';
                $option .= $row["studentid_kn"].'-';
                $option .= $row["yearofstudy_kn"].'-';
                $option .= $row["birthplace_kn"];
                $option .= "</option>";
                echo $option;
                $i++;
            }
            ?>
        </select>

        <table>
            <tr><td>Update</td></tr>
            <tr><td>Student Firstname</td><td><input type="text" name="updated_firstname_kn"></td></tr>
            <tr><td>Student Lastname</td><td><input type="text" name="updated_lastname_kn"></td></tr>
            <tr><td>Student ID</td><td><input type="text" name="updated_studentid_kn"></td></tr>
            <tr><td>Year of Study</td><td><input type="text" name="updated_yearofstudy_kn"></td></tr>
            <tr><td>Birth Place Location</td><td><input type="text" name="updated_birthplace_kn"></td></tr>
        </table>
        
        <input type="submit" value="Update">
    </form>

    <?php include 'PHP_Narayana/nav.php'?>
    <?php include 'PHP_Narayana/footer.php'?>
</body>
</html>