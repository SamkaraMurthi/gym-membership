<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'PHP_Animashaun/HeadPartHtml.php'?>
    <?php include 'PHP_Animashaun/ResultProductKN.php'?>
</head>
<body>
    <?php include 'PHP_Animashaun/header.php'?>
    <article>
        Update Student Data <br>
    </article>
    <article>
        Select Student Data <br>
    </article>
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