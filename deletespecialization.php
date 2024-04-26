<?php
// Include the connection file
include 'connection.php';

// Check if a specialization ID is received for deletion
if (isset($_POST['specialization_id'])) {
    $specialization_id = $_POST['specialization_id'];

    // Prepare a DELETE statement
    $delete_sql = "DELETE FROM specialization WHERE ID = ?";
    
    // Prepare and bind the statement
    $delete_stmt = mysqli_prepare($con, $delete_sql);
    mysqli_stmt_bind_param($delete_stmt, "i", $specialization_id);

    // Execute the DELETE statement
    if (mysqli_stmt_execute($delete_stmt)) {
        echo "Specialization deleted successfully.";
    } else {
        echo "Error deleting specialization: " . mysqli_error($con);
    }

    // Close the DELETE statement
    mysqli_stmt_close($delete_stmt);
}

// Fetch all specializations from the database
$select_sql = "SELECT * FROM specialization";
$select_result = mysqli_query($con, $select_sql);

// Check if there are any specializations
if (mysqli_num_rows($select_result) > 0) {
    echo "<h2>List of Specializations:</h2>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Specialization</th>
                <th>Creation Date</th>
                <th>Action</th>
            </tr>";
    // Output data of each row
    while ($row = mysqli_fetch_assoc($select_result)) {
        echo "<tr>
                <td>" . $row["ID"] . "</td>
                <td>" . $row["Specialization"] . "</td>
                <td>" . $row["CreationDate"] . "</td>
                <td>
                    <form method='post' action=''>
                        <input type='hidden' name='specialization_id' value='" . $row["ID"] . "'>
                        <input type='submit' value='Delete'>
                    </form>
                </td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close the connection
mysqli_close($con);
?>
