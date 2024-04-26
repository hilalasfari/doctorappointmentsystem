<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor</title>
    <style>
        body {
       font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('img/adddoctor.jpg'); /* Path to your background image */
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
        .error-message {
            color: #ff0000;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h2>Add Doctor</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="fullName">Full Name:</label>
  <input type="text" id="fullName" name="fullName">
  
  <label for="mobileNumber">Mobile Number:</label>
  <input type="text" id="mobileNumber" name="mobileNumber" required maxlength=8>
  
  <label for="email">Email:</label>
  <input type="email" id="email" name="email">
  
  <label for="specialization">Specialization:</label>
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
  </select>
  
  <label for="password">Password:</label>
  <input type="password" id="password" name="password">
  
  <input type="submit" name="submit" value="Submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Process form submission
  $fullName = $_POST['fullName'];
  $mobileNumber = $_POST['mobileNumber'];
  $email = $_POST['email'];
  $specialization = $_POST['specialization'];
  $password = $_POST['password'];

  // Prepare SQL statement
  $sql = "INSERT INTO doctor (FullName, MobileNumber, Email, Specialization, Password) VALUES ('$fullName', '$mobileNumber', '$email', '$specialization', '$password')";

  if (mysqli_query($con, $sql)) {
    echo "<p style='color: green;'>Doctor added successfully</p>";
  } else {
    echo "<p class='error-message'>Error: " . mysqli_error($con) . "</p>";
  }
}
?>

</body>
</html>
