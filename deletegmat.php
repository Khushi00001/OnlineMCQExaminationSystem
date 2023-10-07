<?php
// Connection to the database
session_start();
include "config.php";
// if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("Location: gmat.php");
//     exit;
//}

// Function to delete a task
function deleteTask($conn, $id)
{
    // Perform validations
    if (empty($id)) {
        echo "Invalid Question ID.";
        return;
    }

    // Prepare the query
    $query = "DELETE FROM gmat WHERE id = '$id'";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        echo "Question deleted successfully!";
    } 
    else {
        echo "Error deleting task: " . mysqli_error($conn);
    }
}

// Check if task ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the task
    deleteTask($conn, $id);
}

// Close the database connection
mysqli_close($conn);
?>