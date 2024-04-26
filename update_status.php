<?php
session_start();
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appointment_id = $_POST['appointment_id'];
    $status = $_POST['status'];

    // Update appointment status
    $sql = "UPDATE appointment SET Status='$status' WHERE ID=$appointment_id";
    if (mysqli_query($con, $sql)) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . mysqli_error($con);
    }
} else {
    echo "Invalid request method";
}
?>
