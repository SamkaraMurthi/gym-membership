<!DOCTYPE html>
<html lang="en">
    <head>
    <?php include 'PHP_Animashaun/HeadPartHtml.php'?>
    <?php include 'PHP_Animashaun/ResultProductKN.php'?>
    </head>
<body>
    <?php include 'PHP_Animashaun/header.php'?>
    <article>
        Delete GYM MEMBER <br>
    </article>
    <form action="see_member.php" method="POST">
        <select name="delete">
            <?php
            $i=0;
            while ($i<$num){
                $rs->data_seek($i);
                $row = $rs->fetch_assoc();
                $option = "<option value=".$row["id"].">";
                $option .=$row["firstname"].'-';
                $option .=$row["lastnamer"].'-';
                $option .=$row["gym_member_id"].'-';
                $option .=$row["membership_duration"];
                $option .=$row["membership_location"];
                $option .="</option>";
                echo $option;
                $i++;
            }
            ?>
        </select>
        <input type="submit" value="Delete">
    </form>
    <?php include 'PHP_Animashaun/nav.php'?>
    <?php include 'PHP_Animashaun/footer.php'?>
</body>
</html>