<!DOCTYPE html>
<html lang="en">
    <head>
    <?php include 'PHP_Narayana/HeadPartHtml.php'?>
    <?php include 'PHP_Narayana/ResultProductKN.php'?>
    </head>
<body>
    <?php include 'PHP_Narayana/header.php'?>
    <article>
        Delete Your Properties <br>
    </article>
    <form action="see_kn.php" method="POST">
        <select name="delete">
            <?php
            $i=0;
            while ($i<$num){
                $rs->data_seek($i);
                $row = $rs->fetch_assoc();
                $option = "<option value=".$row["id"].">";
                $option .=$row["firstname_kn"].'-';
                $option .=$row["lastnamer_kn"].'-';
                $option .=$row["studentid_kn"].'-';
                $option .=$row["yearofstudy_kn"];
                $option .=$row["birthplace_kn"];
                $option .="</option>";
                echo $option;
                $i++;
            }
            ?>
        </select>
        <input type="submit" value="Delete">
    </form>
    <?php include 'PHP_Narayana/nav.php'?>
    <?php include 'PHP_Narayana/footer.php'?>
</body>
</html>