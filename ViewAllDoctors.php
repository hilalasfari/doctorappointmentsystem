<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Doctors by Speciality</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-image: url('img/viewalldoctors.jpg'); /* Path to your background image */
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
  }
  h2 {
    text-align: center;
    margin-top: 30px;
    margin-bottom: 20px;
    color: #fff; /* White text color */
  }
  table {
    width: 80%; /* Adjust as needed */
    margin: 0 auto;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 10px; /* Rounded corners */
    overflow: hidden;
    background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Soft shadow */
  }
  th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }
  th {
    background-color: #007bff; /* Blue header */
    color: white;
  }
  tr:hover {
    background-color: #f2f2f2; /* Light gray on hover */
  }
  .no-data {
    text-align: center;
    padding: 20px;
  }
</style>
</head>
<body>

<h2>View Doctors by Speciality</h2>

<form method="get" action="">
  <input type="text" name="specialty" placeholder="Enter Specialty">
  <input type="submit" value="Search">
</form>

<table>
  <tr>
    <th>ID</th>
    <th>Full Name</th>
    <th>Mobile Number</th>
    <th>Email</th>
    <th>Specialization</th>
  </tr>
  <?php
  // Check if a specialty is entered in the search bar
  if(isset($_GET['specialty'])) {
    $search_specialty = mysqli_real_escape_string($con, $_GET['specialty']);
    // Fetch doctors by the entered specialty from the database
    $sql = "SELECT d.ID, d.FullName, d.MobileNumber, d.Email, s.Specialization 
            FROM doctor d
            INNER JOIN specialization s ON d.Specialization = s.ID
            WHERE s.Specialization LIKE '%$search_specialty%'";
  } else {
    // Fetch all doctors if no specialty is entered
    $sql = "SELECT d.ID, d.FullName, d.MobileNumber, d.Email, s.Specialization 
            FROM doctor d
            INNER JOIN specialization s ON d.Specialization = s.ID";
  }
  $result = mysqli_query($con, $sql);

  // Output data
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . $row["ID"] . "</td>";
      echo "<td>" . $row["FullName"] . "</td>";
      echo "<td>" . $row["MobileNumber"] . "</td>";
      echo "<td>" . $row["Email"] . "</td>";
      echo "<td>" . $row["Specialization"] . "</td>";
      echo "</tr>";
    }
  } else {
    echo "<tr><td colspan='5' class='no-data'>No doctors found</td></tr>";
  }
  ?>
</table>

</body>
</html>
