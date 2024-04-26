<!DOCTYPE html>
<html>
<head>
    <title>Add Time Slot</title>
</head>
<body>
    <h2>Add New Time Slot</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br><br>
        
        <label for="time">Time:</label>
        <input type="time" id="time" name="time" required><br><br>
        
        <input type="submit" value="Add Time Slot">
    </form>

    <?php
    // Process the form submission
    require 'connection.php'; // Include your database connection file

    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve and sanitize the form data
        $date = mysqli_real_escape_string($con, $_POST['date']);
        $time = mysqli_real_escape_string($con, $_POST['time']);
        $isBooked = 0; // Assuming the slot is initially not booked
        
        // Check if all required fields are filled
        if (empty($date) || empty($time)) {
            echo "Please fill in all fields.";
        } else {
            // Check if the selected time slot already exists
            $checkSlotQuery = "SELECT * FROM `slot` WHERE `Date` = '$date' AND `Time` = '$time'";
            $result = mysqli_query($con, $checkSlotQuery);

            if (mysqli_num_rows($result) > 0) {
                echo "This time slot already exists.";
            } else {
                // Insert the new time slot
                $insertSlotQuery = "INSERT INTO `slot` (`Date`, `Time`, `IsBooked`) VALUES ('$date', '$time', '$isBooked')";
                if (mysqli_query($con, $insertSlotQuery)) {
                    echo "Time slot inserted successfully!";
                } else {
                    echo "Error inserting time slot: " . mysqli_error($con);
                }
            }
        }
    }
    ?>
</body>
</html>
