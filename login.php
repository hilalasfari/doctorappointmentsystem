<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        /* Your CSS styles here */
        @import url("https://fonts.googleapis.com/css2?family=Noto+Sans:wght@700&family=Poppins:wght@400;500;600&display=swap");
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body {
            background: #2980b9;
            height: 100vh;
        }
        .center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 420px;
            width: 100%;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.05);
        }
        .center h1 {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid silver;
        }
        .center form {
            padding: 0 40px;
            box-sizing: border-box;
        }
        form .txt_field {
            position: relative;
            border-bottom: 2px solid #adadad;
            margin: 30px 0;
        }
        .txt_field input {
            width: 100%;
            padding: 0 5px;
            height: 40px;
            font-size: 16px;
            border: none;
            background: none;
            outline: none;
        }
        .txt_field label {
            position: absolute;
            top: 50%;
            left: 5px;
            color: #adadad;
            transform: translateY(-50%);
            font-size: 16px;
            pointer-events: none;
            transition: 0.5s;
        }
        .txt_field span::before {
            content: "";
            position: absolute;
            top: 40px;
            left: 0;
            width: 0%;
            height: 2px;
            background: #2691d9;
            transition: 0.5s;
        }
        .txt_field input:focus ~ label,
        .txt_field input:valid ~ label {
            top: -5px;
            color: #2691d9;
        }
        .txt_field input:focus ~ span::before,
        .txt_field input:valid ~ span::before {
            width: 100%;
        }
        input[type="submit"] {
            width: 100%;
            height: 50px;
            background: #2691d9;
            border-radius: 25px;
            font-size: 18px;
            color: #e9f4fb;
            font-weight: 700;
            cursor: pointer;
            outline: none;
            transition: 0.5s;
            border: none;
        }
        input[type="submit"]:hover {
            border-color: #2691d9;
        }
        .signup_link {
            margin: 30px 0;
            text-align: center;
            font-size: 16px;
            color: #666666;
        }
        .signup_link a {
            color: #2691d9;
            text-decoration: none;
        }
        .signup_link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="center">
    <h1>Login Form</h1>
    <form action="" method="post">
        <div class="txt_field">
            <input type="text" name="us" id="us" required>
            <span></span>
            <label for="us">Username</label>
        </div>
        <div class="txt_field">
            <input type="password" name="pa" id="pa" required>
            <span></span>
            <label for="pa">Password</label>
        </div>
        <input type="submit" name="submit" value="Login">
    </form>
    <div class="signup_link">
        <a href="UserRegistration.php">Don't have an account? Register here</a>
    </div>
    <?php
    session_start();
    require 'connection.php';
    $error = ''; 
    if (isset($_POST['submit'])) {
        if (empty($_POST['us']) || empty($_POST['pa'])) {
            $error = "Username or Password is invalid";
        } else {
            $username = $_POST['us'];
            $password = $_POST['pa'];

            // To protect MySQL injection for Security purpose
            $username = stripslashes($username);
            $password = stripslashes($password);

            $sql = "SELECT * FROM user 
                    WHERE password='" . $password . "' 
                    AND username='" . $username . "'";
            $result = mysqli_query($con, $sql);
            $rows = mysqli_num_rows($result);

            if ($rows == 1) {
                $row = mysqli_fetch_assoc($result);

                $_SESSION['user'] = $username; // Set the Session

                if ($row["usertype"] == "patient") {
                    header("location: patient.php");
                    exit; // Ensure script stops here after redirect
                } elseif ($row["usertype"] == "admin") {
                    header("location: admin.php");
                    exit; // Ensure script stops here after redirect
                } else {
                    echo "Invalid usertype";
                }
            } else {
                $error = "Username or Password is invalid";
            }

            mysqli_close($con); // Closing Connection
        }
    }
    if (!empty($error)) {
        echo "<p class='error'>$error</p>";
    }
    ?>
</div>

</body>
</html>
