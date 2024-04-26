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

// Fetch the list of approved appointments for the logged-in doctor with the corresponding specialization name
$sql = "SELECT appointment.*, specialization.specialization AS Specialization 
        FROM appointment 
        INNER JOIN specialization ON appointment.SID = specialization.ID 
        WHERE DID=$doctorId AND Status='approved'";
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
    <title>Approved Appointments</title>
    <style>
        /* Your CSS styles */
    </style>
</head>

<body>
    <h2>Approved Appointments</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Specialization</th>
                <th>Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if approved appointments exist for the doctor
            if ($result && mysqli_num_rows($result) > 0) {
                // Output data of each approved appointment
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['ID'] . "</td>";
                    echo "<td>" . $row['Specialization'] . "</td>";
                    echo "<td>" . $row['Date'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['Status'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No approved appointments found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>
