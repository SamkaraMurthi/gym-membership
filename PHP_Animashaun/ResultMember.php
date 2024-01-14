<?php
include 'PHP_Animashaun/database.php';
$conn = new mysqli($server, $username, $password, $database);
$query = "SELECT * FROM gym_member";
$rs = $conn->query($query);
$conn->close();
$num = $rs->num_rows;
 ?>
