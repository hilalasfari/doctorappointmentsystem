<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Specialization</title>
    <style>
        body {
         font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('img/specialization.jpg'); /* Path to your background image */
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
        input[type="text"] {
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

<h2>Add Specialization</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="specialization">Specialization:</label><br>
  <input type="text" id="specialization" name="specialization"><br><br>
  <input type="submit" name="submit" value="Submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Process form submission
  $specializationName = $_POST['specialization'];

  // Insert into database
  $sql = "INSERT INTO specialization (Specialization) VALUES ('$specializationName')";

  if (mysqli_query($con, $sql)) {
    echo "<p style='color: green;'>Specialization added successfully</p>";
  } else {
    echo "<p style='color: red;'>Error: " . mysqli_error($con) . "</p>";
  }
}
?>

</body>
</html>
