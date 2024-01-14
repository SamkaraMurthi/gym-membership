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
    <?php include 'PHP_Animashaun/database.php'?>

    <?php
    $delete = true;
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
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
    <article>
        Delete GYM MEMBER <br>
    </article>

    <!-- Display the table -->
    <table border="1">
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
                    <td><button onclick=\"deleteMember({$row['id']})\">Delete</button></td>
                </tr>";
            $i++;
        }
        ?>
    </table>

    <!-- JavaScript to handle the delete action -->
    <script>
        function deleteMember(id) {
            if (confirm('Are you sure you want to delete this member?')) {
                // Send an AJAX request to delete the member
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Reload the page to update the table
                        location.reload();
                    }
                };
                xhr.open('POST', 'delete_member.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('delete=' + id);
            }
        }
    </script>

    <?php include 'PHP_Animashaun/nav.php'?>
    <?php include 'PHP_Animashaun/footer.php'?>
</body>
</html>