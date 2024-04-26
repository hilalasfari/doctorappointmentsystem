<?php
session_start();
require 'connection.php';

// Fetch the doctor's ID from the session
if (!isset($_SESSION['email'])) {
    // Redirect to the login page if session is not set
    header("location: login.php");
    exit;
}

// Fetch the doctor's ID from the session
$email = $_SESSION['email'];
$sql = "SELECT ID FROM doctor WHERE Email='$email'";
$result = mysqli_query($con, $sql);

if (!$result) {
    // Handle query execution error
    die("Error: " . mysqli_error($con));
}

$row = mysqli_fetch_assoc($result);
$doctorId = $row['ID'];

// Fetch the list of appointments for the logged-in doctor with the corresponding specialization name
$sql = "SELECT appointment.*, specialization.specialization AS Specialization 
        FROM appointment 
        INNER JOIN specialization ON appointment.SID = specialization.ID 
        WHERE DID=$doctorId";
$result = mysqli_query($con, $sql);

if (!$result) {
    // Handle query execution error
    die("Error: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor's Appointments</title>
    <style>
        /* Your CSS styles */
    </style>
</head>
<body>
    <h2>Doctor's Appointments</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Specialization</th>
                <th>Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th> <!-- Added Action column -->
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if appointments exist for the doctor
            if ($result && mysqli_num_rows($result) > 0) {
                // Output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['ID'] . "</td>";
                    echo "<td>" . $row['Specialization'] . "</td>";
                    echo "<td>" . $row['Date'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['Status'] . "</td>";
                    echo "<td>";
                    // Approve Button
                    echo "<form action='update_status.php' method='post'>";
                    echo "<input type='hidden' name='appointment_id' value='" . $row['ID'] . "'>";
                    echo "<input type='hidden' name='status' value='approved'>";
                    echo "<input type='submit' value='Approve'>";
                    echo "</form>";
                    // Cancel Button
                    echo "<form action='update_status.php' method='post'>";
                    echo "<input type='hidden' name='appointment_id' value='" . $row['ID'] . "'>";
                    echo "<input type='hidden' name='status' value='cancelled'>"; // Check the spelling here
                    echo "<input type='submit' value='Cancel'>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No appointments found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
