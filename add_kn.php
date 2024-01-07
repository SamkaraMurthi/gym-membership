<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'PHP_Narayana/HeadPartHtml.php'?>
    <?php include 'PHP_Narayana/database.php'?>
    <?php include 'PHP_Narayana/ResultProductKN.php'?>
</head>
<body>
    <?php include 'PHP_Narayana/header.php'?>
    <?php include 'PHP_Narayana/article.php'?>
    <article>
        <?php
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get data from the form
            $firstname = mysqli_real_escape_string($connection, $_POST["firstname_kn"]);
            $lastname = mysqli_real_escape_string($connection, $_POST["lastname_kn"]);
            $studentid = mysqli_real_escape_string($connection, $_POST["studentid_kn"]);
            $yearofstudy = mysqli_real_escape_string($connection, $_POST["yearofstudy_kn"]);
            $birthplace = mysqli_real_escape_string($connection, $_POST["birthplace_kn"]);

            // Check if the student ID already exists
            $checkQuery = "SELECT * FROM studentdata_kn WHERE studentid_kn = ?";
            $checkStmt = mysqli_prepare($connection, $checkQuery);
            mysqli_stmt_bind_param($checkStmt, "s", $studentid);
            mysqli_stmt_execute($checkStmt);
            $checkResult = mysqli_stmt_get_result($checkStmt);

            if (mysqli_num_rows($checkResult) > 0) {
                // Duplicate student ID found, display user-friendly message
                echo '<script>alert("Student ID already exists. Please choose a different ID.");</script>';
            } else {
                // Insert data into the database
                $insertQuery = "INSERT INTO studentdata_kn(firstname_kn, lastname_kn, studentid_kn, yearofstudy_kn, birthplace_kn) VALUES (?, ?, ?, ?, ?)";
                $insertStmt = mysqli_prepare($connection, $insertQuery);
                mysqli_stmt_bind_param($insertStmt, "sssss", $firstname, $lastname, $studentid, $yearofstudy, $birthplace);

                try {
                    $insertResult = mysqli_stmt_execute($insertStmt);
                    if ($insertResult) {
                        // Data inserted successfully
                        echo '<script>alert("Data added successfully.");</script>';
                    } else {
                        // Error inserting data
                        echo '<script>alert("Error adding data. Please try again.");</script>';
                    }
                } catch (mysqli_sql_exception $e) {
                    // Handle the exception (e.g., log it) and inform the user
                    echo '<script>alert("Error adding data. Please try again.");</script>';
                }

                // Close the prepared statement
                mysqli_stmt_close($insertStmt);
            }

            // Close the prepared statement
            mysqli_stmt_close($checkStmt);
        }
        ?>
        <h2>Add Student Data</h2>
        <form action="see_kn.php" method="POST">
            <table>
                <tr>
                    <td>Student Firstname</td>
                    <td><input type="text" name="firstname_kn"></td>
                </tr>
                <tr>
                    <td>Student Lastname</td>
                    <td><input type="text" name="lastname_kn"></td>
                </tr>
                <tr>
                    <td>Student ID</td>
                    <td><input type="text" name="studentid_kn"></td>
                </tr>
                <tr>
                    <td>Year of Study</td>
                    <td><input type="text" name="yearofstudy_kn"></td>
                </tr>
                <tr>
                    <td>Birth Place Location</td>
                    <td><input type="text" name="birthplace_kn"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Save"></td>
                </tr>
            </table>
        </form>
    </article>
    <?php include 'PHP_Narayana/nav.php'?>
    <?php include 'PHP_Narayana/footer.php'?>
</body>
</html>