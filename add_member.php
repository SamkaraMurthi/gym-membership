<!DOCTYPE html>
<html lang="en">
<head>
<style>
    /* Style for the form */
form {
    max-width: 600px;
    margin: 0 auto;
    background-color: #ecf0f1;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Style for form labels */
form label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

/* Style for form input fields */
form input[type="text"], form select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

/* Style for form submit button */
form input[type="submit"] {
    background-color: #3498db;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

/* Hover effect for the submit button */
form input[type="submit"]:hover {
    background-color: #2980b9;
}

/* Style for form update button */
form input[type="button"] {
    background-color: #e74c3c;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

/* Hover effect for the update button */
form input[type="button"]:hover {
    background-color: #c0392b;
}

/* Style for form cancel button */
form input[type="reset"] {
    background-color: #95a5a6;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

/* Hover effect for the cancel button */
form input[type="reset"]:hover {
    background-color: #7f8c8d;
}
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
    <?php include 'PHP_Animashaun/ResultMember.php'?>
</head>
<body>
    <?php include 'PHP_Animashaun/header.php'?>
    <article>
        <?php
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get data from the form
            $firstname = mysqli_real_escape_string($connection, $_POST["firstname"]);
            $lastname = mysqli_real_escape_string($connection, $_POST["lastname"]);
            $memberid = mysqli_real_escape_string($connection, $_POST["gym_member_id"]);
            $membershipdur = mysqli_real_escape_string($connection, $_POST["membership_duration"]);
            $membershiploc = mysqli_real_escape_string($connection, $_POST["membership_location"]);

            // Check if the Member ID ID already exists
            $checkQuery = "SELECT * FROM gym_member WHERE gym_member_id = ?";
            $checkStmt = mysqli_prepare($connection, $checkQuery);
            mysqli_stmt_bind_param($checkStmt, "s", $memberid);
            mysqli_stmt_execute($checkStmt);
            $checkResult = mysqli_stmt_get_result($checkStmt);

            if (mysqli_num_rows($checkResult) > 0) {
                // Duplicate Member ID found, display user-friendly message
                echo '<script>alert("Membership ID already exists. Please Input a different ID.");</script>';
            } else {
                // Insert data into the database
                $insertQuery = "INSERT INTO gym_member(firstname, lastname, gym_member_id, membership_duration, membership_location) VALUES (?, ?, ?, ?, ?)";
                $insertStmt = mysqli_prepare($connection, $insertQuery);
                mysqli_stmt_bind_param($insertStmt, "sssss", $firstname, $lastname, $memberid, $membershipdur, $membershiploc);

                try {
                    $insertResult = mysqli_stmt_execute($insertStmt);
                    if ($insertResult) {
                        // Data inserted successfully
                        echo '<script>alert("New Member successfully.");</script>';
                    } else {
                        // Error inserting data
                        echo '<script>alert("Error adding new Member. Please try again.");</script>';
                    }
                } catch (mysqli_sql_exception $e) {
                    // Handle the exception (e.g., log it) and inform the user
                    echo '<script>alert("Error adding Member. Please try again.");</script>';
                }

                // Close the prepared statement
                mysqli_stmt_close($insertStmt);
            }

            // Close the prepared statement
            mysqli_stmt_close($checkStmt);
        }
        ?>
        <h2>Add New GYM Member</h2>
        <form action="see_member.php" method="POST">
            <table>
                <tr>
                    <td>Firstname</td>
                    <td><input type="text" name="firstname"></td>
                </tr>
                <tr>
                    <td>Lastname</td>
                    <td><input type="text" name="lastname"></td>
                </tr>
                <tr>
                    <td>GYM ID</td>
                    <td><input type="text" name="gym_member_id"></td>
                </tr>
                <tr>
                    <td>GYM Duration</td>
                    <td><input type="text" name="membership_duration"></td>
                </tr>
                <tr>
                    <td>GYM Location</td>
                    <td><input type="text" name="membership_location"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Save"></td>
                </tr>
            </table>
        </form>
    </article>
    <?php include 'PHP_Animashaun/nav.php'?>
    <?php include 'PHP_Animashaun/footer.php'?>
</body>
</html>