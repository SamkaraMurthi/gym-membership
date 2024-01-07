<?php
include 'PHP_Narayana/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $update_id = $_POST['update_id'];
    $updated_firstname_kn = $_POST['updated_firstname_kn'];
    $updated_lastname_kn = $_POST['updated_lastname_kn'];
    $updated_studentid_kn = $_POST['updated_studentid_kn'];
    $updated_yearofstudy_kn = $_POST['updated_yearofstudy_kn'];
    $updated_birthplace_kn = $_POST['updated_birthplace_kn'];

    $conn = new mysqli($server, $username, $password, $database);

    // Check if another record already has the same student ID
    $check_query = "SELECT id FROM studentdata_kn WHERE studentid_kn = '$updated_studentid_kn' AND id != '$update_id'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        echo '<script>';
        echo 'alert("Error: Another student already has the same student ID. Please choose a different student ID.");';
        echo 'window.location.href = "update.php";'; // Redirect to update.php
        echo '</script>';
    } else {
        // Continue with the update if the student ID is unique
        $update_query = "UPDATE studentdata_kn SET 
                        firstname_kn = '$updated_firstname_kn', 
                        lastname_kn = '$updated_lastname_kn', 
                        studentid_kn = '$updated_studentid_kn', 
                        yearofstudy_kn = '$updated_yearofstudy_kn', 
                        birthplace_kn = '$updated_birthplace_kn'
                        WHERE id = '$update_id'";

        if ($conn->query($update_query) === TRUE) {
            echo '<script>';
            echo 'alert("Record updated successfully");';
            echo 'window.location.href = "see_kn.php";'; // Redirect to see_kn.php
            echo '</script>';
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    $conn->close();
}
?>