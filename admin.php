<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8i6+qLXR5Pe6NEe1zOWPG7h8m9Sm3/J6ft9t8=" crossorigin="anonymous">
    <style>
        body {
         font-family: Arial, sans-serif;
        background-image: url('img/blueback.jpg');
        margin: 0;
        padding: 0; /* Path to your background image */
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
            
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .admin-header {
            background-color: #007bff; /* Bootstrap primary color */
            color: white;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
        }

        .card {
            background-color: #ffffff; /* White background */
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Shadow for the card */
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px); /* Move the card up on hover */
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .card-link {
            color: #007bff; /* Bootstrap primary color */
            text-decoration: none;
            transition: color 0.3s;
        }

        .card-link:hover {
            color: #0056b3; /* Darker shade of primary color on hover */
        }

        #logout {
            text-align: center;
            margin-top: 20px;
        }

        #logout a {
            color: #ffffff; /* White color for text */
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #dc3545; /* Bootstrap danger color */
            display: inline-block;
            transition: background-color 0.3s;
        }

        #logout a:hover {
            background-color: #c82333; /* Darker shade of danger color on hover */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="admin-header">
            <h1>Admin Dashboard</h1>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View All Doctors</h5>
                        <a href="ViewAllDoctors.php" class="card-link">Go to View All Doctors</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Doctor</h5>
                        <a href="AddDoctor.php" class="card-link">Go to Add Doctor</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Specialization</h5>
                        <a href="AddSpecialization.php" class="card-link">Go to Add Specialization</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Update Doctor</h5>
                        <a href="UpdateDoctor.php" class="card-link">Go to Update Doctor</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Delete Doctor</h5>
                        <a href="DeleteDoctor.php" class="card-link">Go to Delete Doctor</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View All Appointments</h5>
                        <a href="VAP.php" class="card-link">Go to View All Appointments</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Insert Date & Time</h5>
                        <a href="insertdatetime.php" class="card-link">Go to Insert Date & Time</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Delete Specialization</h5>
                        <a href="deletespecialization.php" class="card-link">Go to Delete Specialization</a>
                    </div>
                </div>
            </div>
        </div>

        <div id="logout">
            <a href="logout.php">Log Out</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofP+WiHAeIM99jAyFxnZbJFZB/YUq5S1dA" crossorigin="anonymous"></script>
</body>

</html>
