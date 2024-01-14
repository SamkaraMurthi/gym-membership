<?php
include 'PHP_Animashaun/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $update_id = $_POST['update_id'];
    $updated_firstname = $_POST['updated_firstname'];
    $updated_lastname = $_POST['updated_lastname'];
    $updated_gym_member_id = $_POST['updated_gym_member_id'];
    $updated_membership_duration = $_POST['updated_membership_duration'];
    $updated_membership_location = $_POST['updated_membership_location'];

    $conn = new mysqli($server, $username, $password, $database);

    // Check if another record already has the same student ID
    $check_query = "SELECT id FROM gym_member WHERE gym_member_id = '$updated_gym_member_id' AND id != '$update_id'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        echo '<script>';
        echo 'alert("Error: Another Member already has the same GYM ID. Please choose a GYM ID.");';
        echo 'window.location.href = "update.php";'; // Redirect to update.php
        echo '</script>';
    } else {
        // Continue with the update if the GYM ID is unique
        $update_query = "UPDATE gym_member SET 
                        firstname = '$updated_firstname', 
                        lastname = '$updated_lastname', 
                        gym_member_id = '$updated_gym_member_id', 
                        membership_duration = '$updated_membership_duration', 
                        membership_location = '$updated_membership_location'
                        WHERE id = '$update_id'";

        if ($conn->query($update_query) === TRUE) {
            echo '<script>';
            echo 'alert("Record updated successfully");';
            echo 'window.location.href = "see_member.php";';
            echo '</script>';
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    $conn->close();
}
?>