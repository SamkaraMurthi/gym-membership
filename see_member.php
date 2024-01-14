<!DOCTYPE html>
<html lang="en">
<head>
<style>
        body{
            background-image: url("images/bg2.jpg")
        };
        /* Place the CSS code here */
        table {
            width: 50%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
    background-color: #3498db;
    color: #fff;
    padding: 15px;
    text-align: left;
}

/* Style for table cells */
td {
    padding: 10px;
    border: 1px solid #ddd;
    background-color: #fff; /* Set the background color to white */
}

/* Style for alternate rows */
tr:nth-child(even) {
    background-color: #f2f2f2;
}
        button {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #c0392b;
        }

        /* Style for the navigation */
        nav {
    width: 100%;
    margin: 0 auto;
    margin-bottom: 20px;
}

/* Style for the navigation links */
nav a {
    display: inline-block;
    padding: 10px 15px;
    text-decoration: none;
    color: #fff;
    background-color: #3498db;
    border: 1px solid #2980b9;
    border-radius: 5px;
    margin-right: 5px;
}

/* Remove underline on hover */
nav a:hover {
    text-decoration: none;
}

/* Style for the navigation table */
nav table {
    width: 70%;
    margin: 0 auto;
}

/* Style for navigation table cells */
nav td {
    padding: 0;
}

/* Style for navigation table links */
nav td a {
    display: block;
    padding: 10px 15px;
    text-decoration: none;
    color: #fff;
    background-color: #3498db;
    border: 1px solid #2980b9;
    border-radius: 5px;
    margin-right: 5px;
}

/* Remove underline on hover for navigation table links */
nav td a:hover {
    text-decoration: none;
}
    </style>
    <?php include 'PHP_Animashaun/HeadPartHtml.php'?>
    <?php
    include 'PHP_Animashaun/database.php';

    $entry = true;

    if (isset($_POST['firstname'])) {$firstname = $_POST['firstname'];} else {$entry = false;}
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
    <?php include 'PHP_Animashaun/nav.php'?>
    <?php include 'PHP_Animashaun/footer.php'?>
</body>
</html>