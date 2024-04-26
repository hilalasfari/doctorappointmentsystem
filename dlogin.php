<?php
session_start();
require 'connection.php';
$error = ''; 

if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $error = "Email or Password is invalid";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // To protect MySQL injection for Security purpose
        $email = stripslashes($email);
        $password = stripslashes($password);

        $sql = "SELECT * FROM doctor 
                WHERE Email='" . $email . "' 
                AND Password='" . $password . "'";
        $result = mysqli_query($con, $sql);
        $rows = mysqli_num_rows($result);

        if ($rows == 1) {
            $row = mysqli_fetch_assoc($result);

            // Start the session and set the session variable
            $_SESSION['email'] = $email;

            // Redirect to doctorform.php
            header("location: doctorform.php");
            exit; // Prevent further execution of the script after redirection
        } else {
            $error = "Email or Password is invalid";
        }

        mysqli_close($con); // Closing Connection
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Doctor-Login Form</title>
    <style>
        /* Your CSS styles */
    </style>
</head>
<body>
    <form action="" method="post">
        <h1>Login Form</h1>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <input type="submit" name="submit" value="Login">
    </form>

    <?php
    if (!empty($error)) {
        echo "<p class='error'>$error</p>";
    }
    ?>
</body>
</html>
