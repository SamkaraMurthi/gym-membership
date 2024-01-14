<?php
    $i=0;
    while ($i<$num){
    $rs->data_seek($i);
    $row = $rs->fetch_assoc();
    echo "<tr>";
    echo "<td>".$row["id"]."</td>";
    echo "<td>".$row["firstname"]."</td>";
    echo "<td>".$row["lastname"]."</td>";
    echo "<td>".$row["gym_member_id"]."</td>";
    echo "<td>".$row["membership_duration"]."</td>";
    echo "<td>".$row["membership_location"]."</td>";
    echo "</tr>";
    $i++;
    }
?>