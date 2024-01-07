<?php
include 'PHP_Narayana/database.php';
$conn = new mysqli($server, $username, $password, $database);
$query = "SELECT * FROM buy_kn";
$rs = $conn->query($query);
$conn->close();
$num = $rs->num_rows;
 ?>
