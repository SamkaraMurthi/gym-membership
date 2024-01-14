<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'PHP_Animashaun/HeadPartHtml.php'?>
    <?php include 'PHP_Animashaun/database.php'?>
    <?php include 'PHP_Animashaun/ResultMember.php'?>
</head>
<body>
    <?php include 'PHP_Animashaun/header.php'?>
    <?php include 'PHP_Animashaun/article.php'?>
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