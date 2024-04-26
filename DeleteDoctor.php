<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Delete Doctor</title>
<style>
    body {
      font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('img/slider.jpg'); /* Path to your background image */
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
    h2 {
        text-align: center;
        margin-top: 30px;
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    table, th, td {
        border: 1px solid #ddd;
    }
    th, td {
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    input[type="text"],
    input[type="submit"] {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 16px;
    }
    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>

<h2>Delete Doctor</h2>

<!-- Form to delete doctor -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="doctorId">Doctor ID:</label><br>
  <input type="text" id="doctorId" name="doctorId"><br><br>
  <input type="submit" name="submit" value="Delete">
</form>

<!-- Display list of doctors -->
<table>
  <tr>
    <th>ID</th>
    <th>Full Name</th>
    <th>Mobile Number</th>
    <th>Email</th>
    <th>Specialization</th>
  </tr>
  <?php
  // Fetch doctors from the database
  $sql = "SELECT d.ID, d.FullName, d.MobileNumber, d.Email, s.Specialization 
          FROM doctor d
          INNER JOIN specialization s ON d.Specialization = s.ID";
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
    echo "<tr><td colspan='5'>No doctors found</td></tr>";
  }
  ?>
</table>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Process form submission
  $doctorId = $_POST['doctorId'];

  // Delete from database
  $sql = "DELETE FROM doctor WHERE ID = '$doctorId'";

  if (mysqli_query($con, $sql)) {
    // Refresh the page to update the list of doctors
    echo "<meta http-equiv='refresh' content='0'>";
  } else {
    echo "Error: " . mysqli_error($con);
  } 
}
?>

</body>
</html>
