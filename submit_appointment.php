<?php
require 'connection.php'; // Include your database connection file

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize the form data
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $specialization = mysqli_real_escape_string($con, $_POST['specialization']);
    $doctor = mysqli_real_escape_string($con, $_POST['doctor']);
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $time = mysqli_real_escape_string($con, $_POST['time']); // Assuming the name of the field is "time"
    
    // Check if all required fields are filled
    if (empty($name) || empty($email) || empty($specialization) || empty($doctor) || empty($date) || empty($time)) {
        echo "Please fill in all fields.";
    } else {
        // Check if the selected time slot is available
        $checkSlotQuery = "SELECT * FROM `slot` WHERE `Date` = '$date' AND `Time` = '$time' AND `IsBooked` = 0";
        $result = mysqli_query($con, $checkSlotQuery);

        if (mysqli_num_rows($result) > 0) {
            // Time slot is available, book the appointment
            $row = mysqli_fetch_assoc($result);
            $slotID = $row['SlotID'];
            
            // Assuming $uid is set elsewhere in your code
            $uid = 1; // Replace with the correct value
            
            // Insert the appointment
            $insertAppointmentQuery = "INSERT INTO `appointment` (`UID`, `SID`, `DID`, `Date`, `name`, `email`) VALUES ('$uid', '$specialization', '$doctor', '$date', '$name', '$email')";
            if (mysqli_query($con, $insertAppointmentQuery)) {
                // Update the slot to mark it as booked
                $updateSlotQuery = "UPDATE `slot` SET `IsBooked` = 1 WHERE `SlotID` = '$slotID'";
                if (mysqli_query($con, $updateSlotQuery)) {
                    echo "Appointment booked successfully!";
                } else {
                    echo "Error updating slot: " . mysqli_error($con);
                }
            } else {
                echo "Error booking appointment: " . mysqli_error($con);
            }
        } else {
            echo "Selected time slot is not available. Please choose another slot.";
        }
    }
} else {
    // Form was not submitted properly
    echo "Form submission failed!";
}
?>
