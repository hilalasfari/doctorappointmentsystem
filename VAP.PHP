<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Appointments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('img/checkapp.jpg'); /* Path to your background image */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333; /* Dark grey color */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff; /* Blue color */
            color: #fff; /* White color */
        }
        tr:hover {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<h2>View Appointments</h2>

<?php
require 'connection.php'; // Include your database connection file

// Fetch all appointments with corresponding specialization and doctor names from the database
$sql = "SELECT a.ID, a.name, a.email, s.Specialization AS specialization, d.FullName AS doctor, a.Date, sl.Time AS time
        FROM appointment a
        INNER JOIN specialization s ON a.SID = s.ID
        INNER JOIN doctor d ON a.DID = d.ID
        INNER JOIN slot sl ON a.Date = sl.Date
        WHERE sl.IsBooked = 1";
$result = mysqli_query($con, $sql);

// Check if any appointments were found
if (mysqli_num_rows($result) > 0) {
    // Output table header
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Specialization</th><th>Doctor</th><th>Date</th><th>Time</th></tr>";

    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["ID"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["specialization"] . "</td>";
        echo "<td>" . $row["doctor"] . "</td>";
        echo "<td>" . $row["Date"] . "</td>";
        echo "<td>" . $row["time"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No appointments found";
}

// Close the database connection
mysqli_close($con);
?>

</body>
</html>
