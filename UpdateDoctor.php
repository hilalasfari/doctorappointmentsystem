<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Doctor</title>
    <style>
        body {
          font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('img/updatedoctor.jpg'); /* Path to your background image */
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        }
        h2 {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 20px;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h2>Update Doctor</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="doctorId">Doctor ID:</label><br>
  <input type="text" id="doctorId" name="doctorId"><br>
  <label for="fullName">Full Name:</label><br>
  <input type="text" id="fullName" name="fullName"><br>
  <label for="mobileNumber">Mobile Number:</label><br>
  <input type="text" id="mobileNumber" name="mobileNumber"><br>
  <label for="email">Email:</label><br>
  <input type="email" id="email" name="email"><br>
  <label for="specialization">Specialization:</label><br>
  <select id="specialization" name="specialization">
    <?php
    // Fetch specializations from the database
    $sql = "SELECT ID, Specialization FROM specialization";
    $result = mysqli_query($con, $sql);

    // Output options
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        echo "<option value='" . $row["ID"] . "'>" . $row["Specialization"] . "</option>";
      }
    } else {
      echo "<option value=''>No specializations found</option>";
    }
    ?>
  </select><br>
  <label for="password">Password:</label><br>
  <input type="password" id="password" name="password"><br><br>
  <input type="submit" name="submit" value="Update">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Process form submission
  $doctorId = $_POST['doctorId'];
  $fullName = $_POST['fullName'];
  $mobileNumber = $_POST['mobileNumber'];
  $email = $_POST['email'];
  $specialization = $_POST['specialization'];
  $password = $_POST['password'];

  // Update doctor in database
  $sql = "UPDATE doctor SET FullName = '$fullName', MobileNumber = '$mobileNumber', Email = '$email', Specialization = '$specialization', Password = '$password' WHERE ID = '$doctorId'";

  if (mysqli_query($con, $sql)) {
    echo "<p style='color: green;'>Doctor updated successfully</p>";
  } else {
    echo "<p style='color: red;'>Error: " . mysqli_error($con) . "</p>";
  }
}
?>

</body>
</html>
