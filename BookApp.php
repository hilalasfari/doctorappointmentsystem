<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Book Appointment</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-image: url('img/bookapp.jpg'); /* Path to your background image */
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
  }
  h2 {
    text-align: center;
    color: #ffffff; /* White text color */
    padding-top: 50px; /* Adjust as needed */
  }
  form {
    max-width: 500px;
    margin: 0 auto;
    background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Soft shadow */
  }
  label {
    display: block;
    margin-bottom: 5px;
  }
  input[type="text"],
  input[type="email"],
  select,
  textarea,
  input[type="time"],
  input[type="date"] {
    width: 100%;
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
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  input[type="submit"]:hover {
    background-color: #45a049; /* Darker green on hover */
  }
</style>
</head>
<body>

<h2>Book Appointment</h2>
<form method="post" action="submit_appointment.php">
  <label for="name">Name:</label><br>
  <input type="text" id="name" name="name" required><br>
  
  <label for="email">Email:</label><br>
  <input type="email" id="email" name="email" required><br>
  
  <label for="specialization">Specialization:</label><br>
  <select id="specialization" name="specialization" onchange="getDoctors(this.value)" required>
    <option value="">Select Specialization</option>
    <?php
    include 'connection.php';
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
  
  <label for="doctor">Doctor:</label><br>
  <select id="doctor" name="doctor" required>
    <option value="">Select Doctor</option>
  </select><br>
  
  <label for="date">Date:</label><br>
  <input type="date" id="date" name="date" required><br>
  
  
  <label for="time">Time:</label><br>
  <input type="time" id="time" name="time" required><br><br>
  
  <input type="submit" name="submit" value="Book Appointment">
</form>

<script>
function getDoctors(specializationId) {
  console.log("Specialization ID:", specializationId); // Debugging

  var doctorSelect = document.getElementById('doctor');
  doctorSelect.innerHTML = '<option value="">Select Doctor</option>';

  // Fetch doctors based on selected specialization using AJAX
  if (specializationId !== '') {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_doctors.php?specialization=' + specializationId, true);
    xhr.onload = function () {
      if (xhr.status === 200) {
        console.log("Response:", xhr.responseText); // Debugging
        
        var doctors = JSON.parse(xhr.responseText);
        console.log("Doctors:", doctors); // Debugging
        
        doctors.forEach(function (doctor) {
          var option = document.createElement('option');
          option.text = doctor.FullName; // Assuming the property name is FullName
          option.value = doctor.ID;
          doctorSelect.appendChild(option);
        });
      }
    };
    xhr.send();
  }
}
</script>

</body>
</html>
