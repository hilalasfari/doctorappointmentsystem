<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search Appointments</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('img/checkapp.jpg'); /* Path to your background image */
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    h2 {
        text-align: center;
        color: #ffffff; /* White text color */
    }
    form {
        background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Soft shadow */
        max-width: 400px;
        width: 100%;
    }
    label {
        display: block;
        margin-bottom: 5px;
    }
    input[type="text"] {
        width: calc(100% - 100px); /* Adjust as needed */
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }
    input[type="submit"] {
        width: 100%;
        background-color: #4caf50; /* Green submit button */
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #45a049; /* Darker green on hover */
    }
</style>
</head>
<body>

<h2>Search Appointments by Name</h2>
<form method="post" action="">
    <label for="searchName">Search by Name:</label>
    <input type="text" id="searchName" name="searchName">
    <input type="submit" name="submit" value="Search">
</form>

</body>
</html>
<?php
session_start();
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the search form was submitted
    if(isset($_POST['submit'])){
        // Sanitize the input to prevent SQL injection
        $searchName = mysqli_real_escape_string($con, $_POST['searchName']);

        // Query to search for appointments by name
        $sql = "SELECT * FROM appointment WHERE name LIKE '%$searchName%'";

        // Perform the query
        $result = mysqli_query($con, $sql);

        if (!$result) {
            // Handle query execution error
            die("Error: " . mysqli_error($con));
        }

        // Display the search results
        if (mysqli_num_rows($result) > 0) {
            echo "<h3>Search Results:</h3>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Date</th><th>Name</th><th>Email</th><th>Status</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['ID'] . "</td>";
                echo "<td>" . $row['Date'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['Status'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No appointments found with the name '$searchName'.</p>";
        }
    }
}
?>
