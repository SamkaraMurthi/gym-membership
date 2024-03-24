<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include 'php/database.php';

    $entry = true;

    if (isset($_POST['firstname'])) {$firstname = $_POST['firstname'];} else {$entry = false;}
    if (isset($_POST['lastname'])) {$lastname = $_POST['lastname'];} else {$entry = false;}
    if (isset($_POST['gym_member_id'])) {$gym_member_id = $_POST['gym_member_id'];} else {$entry = false;}
    if (isset($_POST['membership_duration'])) {$membership_duration = $_POST['membership_duration'];} else {$entry = false;}
    if (isset($_POST['membership_location'])) {$membership_location = $_POST['membership_location'];} else {$entry = false;}

    if ($entry) {
        $conn = new mysqli($server, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO gym_member(firstname, lastname, gym_member_id, membership_duration, membership_location) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstname, $lastname, $gym_member_id, $membership_duration, $membership_location);

        try {
            $stmt->execute();
            echo '<script>alert("New Member added successfully.");</script>';
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) {
                echo '<script>alert("GYM ID already exists. Please input a different ID."); window.location.href = "add_member.php";</script>';
            } else {
                echo '<script>alert("Error adding New Member. Please try again.");</script>';
            }
        }

        $stmt->close();
    }

    $delete = true;
    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        $conn = new mysqli($server, $username, $password, $database);
        $query = "DELETE FROM gym_member WHERE id='".$id."'";
        $conn->query($query);
        $conn->close();
    }

    include 'php/result.php';
    ?>
</head>
<body>
    <!-- Form for updating student data -->
    <form action="updateexe.php" method="POST" id="form1" style="display: none;">
        <input type="hidden" name="update_id" id="update_id_input">
        <table>
            <tr><td>Update and Delete Data</td></tr>
            <tr><td>Firstname</td><td><input type="text" name="updated_firstname" id="updated_firstname"></td></tr>
            <tr><td>Lastname</td><td><input type="text" name="updated_lastname" id="updated_lastname"></td></tr>
            <tr><td>GYM ID</td><td><input type="text" name="updated_gym_member_id" id="updated_gym_member_id"></td></tr>
            <tr><td>Membership Duration</td><td><input type="text" name="updated_membership_duration" id="updated_membership_duration"></td></tr>
            <tr><td>Membership Location</td><td><input type="text" name="updated_membership_location" id="updated_membership_location"></td></tr>
        </table>
        
        <input type="submit" value="Update">
        <input type="button" value="Cancel" onclick="cancelUpdate()">
    </form>

    <!-- Display the table -->
    <table border="1" id="initial-table">
        <tr>
            <th>id</th><th>Firstname</th><th>Lastname</th><th>GYM ID</th>
            <th>Membership Duration (Month)</th><th>Membership Locations</th><th>Action</th>
        </tr>
        <?php
        $i = 0;
        while ($i < $num) {
            $rs->data_seek($i);
            $row = $rs->fetch_assoc();
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['firstname']}</td>
                    <td>{$row['lastname']}</td>
                    <td>{$row['gym_member_id']}</td>
                    <td>{$row['membership_duration']}</td>
                    <td>{$row['membership_location']}</td>
                    <td><button type='button' onclick=\"setFormData({$row['id']}, '{$row['firstname']}', '{$row['lastname']}', '{$row['gym_member_id']}', '{$row['membership_duration']}', '{$row['membership_location']}')\">Edit</button></td>
                </tr>";
            $i++;
        }
        ?>
    </table>

    <!-- JavaScript to handle the edit action -->
    <script>
        function setFormData(id, firstname, lastname, gym_member_id, membership_duration, membership_location) {
            document.getElementById('update_id_input').value = id;
            document.getElementById('updated_firstname').value = firstname;
            document.getElementById('updated_lastname').value = lastname;
            document.getElementById('updated_gym_member_id').value = gym_member_id;
            document.getElementById('updated_membership_duration').value = membership_duration;
            document.getElementById('updated_membership_location').value = membership_location;

            document.getElementById('initial-table').style.display = 'none';
            document.getElementById('form1').style.display = 'block';
        }

        function cancelUpdate() {
            // Reset form fields
            document.getElementById('update_id_input').value = '';
            document.getElementById('updated_firstname').value = '';
            document.getElementById('updated_lastname').value = '';
            document.getElementById('updated_gym_member_id').value = '';
            document.getElementById('updated_membership_duration').value = '';
            document.getElementById('updated_membership_location').value = '';

            // Display the initial table
            document.getElementById('initial-table').style.display = 'table';
            document.getElementById('form1').style.display = 'none';
        }
    </script>

    <?php include 'PHP_Animashaun/nav.php'?>
    <?php include 'PHP_Animashaun/footer.php'?>
</body>
</html>