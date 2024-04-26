<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo "You need to login";
    header("Location: index.php");
    exit(); // Add exit to stop further execution
}

require 'connection.php';

// Fetch additional information for the logged-in user
$username = $_SESSION['user'];
$sql = "SELECT * FROM user WHERE username='" . $username . "'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Home</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8i6+qLXR5Pe6NEe1zOWPG7h8m9Sm3/J6ft9t8=" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
        background-image: url('img/5109267.jpg');
        margin: 0;
        padding: 0; /* Path to your background image */
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #007bff;
        }
        #profile {
            margin-top: 20px;
            text-align: center;
        }
        #welcome {
            font-size: 18px;
            color: #007bff;
        }
        #logout a {
            color: #dc3545;
            text-decoration: none;
        }
        #logout a:hover {
            text-decoration: underline;
        }
        .menu-link {
            display: block;
            margin-top: 20px;
            font-size: 18px;
            color: #007bff;
            text-decoration: none;
        }
        .menu-link:hover {
            text-decoration: underline;
        }
        .em{
            color:blue;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student Home</h1>
        <div id="profile">
            <b id="welcome">Welcome : <i>
                    <?php
                    echo $row['username'];
                    ?>
                </i></b>
            <p class=em>Email: <?php echo $row['email']; ?></p>

            <b id="logout"><a href="logout.php">Log Out</a></b>
        </div>
        
        <a href="BookApp.php" class="menu-link">Book appointment</a>
        <hr>
        <a href="CheckApp.php" class="menu-link">Check appointment</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofP+WiHAeIM99jAyFxnZbJFZB/YUq5S1dA" crossorigin="anonymous"></script>
</body>
</html>
