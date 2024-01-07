<?php
    $i=0;
    while ($i<$num){
    $rs->data_seek($i);
    $row = $rs->fetch_assoc();
    echo "<tr>";
    echo "<td>".$row["id"]."</td>";
    echo "<td>".$row["firstname_kn"]."</td>";
    echo "<td>".$row["lastname_kn"]."</td>";
    echo "<td>".$row["studentid_kn"]."</td>";
    echo "<td>".$row["yearofstudy_kn"]."</td>";
    echo "<td>".$row["birthplace_kn"]."</td>";
    echo "</tr>";
    $i++;
    }
?>