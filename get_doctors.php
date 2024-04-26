<?php
include 'connection.php';

// Check if the specialization ID is provided in the request
if (isset($_GET['specialization']) && !empty($_GET['specialization'])) {
    // Sanitize the specialization ID
    $specializationId = $_GET['specialization'];

    // Prepare and execute a query to fetch doctors based on the specialization ID
    $query = "SELECT * FROM doctor WHERE Specialization = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i', $specializationId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the results into an associative array
    $doctors = $result->fetch_all(MYSQLI_ASSOC);

    // Return the list of doctors in JSON format
    echo json_encode($doctors);
} else {
    // Return an error message if the specialization ID is not provided
    echo json_encode(['error' => 'Specialization ID is not provided']);
}
?>
