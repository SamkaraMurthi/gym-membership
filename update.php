<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'PHP_Narayana/HeadPartHtml.php'?>
    <?php include 'PHP_Narayana/ResultProductKN.php'?>
</head>
<body>
    <?php include 'PHP_Narayana/header.php'?>
    <article>
        Update Student Data <br>
    </article>
    <article>
        Select Student Data <br>
    </article>
    <form action="update_kn.php" method="POST">
        <select name="update_id">
            <?php
            $i = 0;
            while ($i < $num) {
                $rs->data_seek($i);
                $row = $rs->fetch_assoc();
                $option = "<option value=".$row["id"].">";
                $option .= $row["firstname_kn"].'-';
                $option .= $row["lastnamer_kn"].'-';
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