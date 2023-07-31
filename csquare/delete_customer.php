<?php
// delete_customer.php

// Database connection
include 'connection.php';

// Check if the 'id' parameter is present in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Check if the customer exists in the database
    $sql = "SELECT * FROM customers WHERE customer_id = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Customer exists, proceed with deletion
        $delete_sql = "DELETE FROM customers WHERE customer_id = '$id'";
        if ($conn->query($delete_sql) === TRUE) {
            $_SESSION['success_message'] = "Customer deleted successfully.";
        } else {
            $_SESSION['error_message'] = "Error deleting customer: " . $conn->error;
        }
    } else {
        // Customer doesn't exist, show a message
        $_SESSION['error_message'] = "Customer not found.";
    }
} else {
    // 'id' parameter not found in the URL
    $_SESSION['error_message'] = "Invalid request.";
}

// Close the database connection
$conn->close();

// Redirect back to the 'customer.php' page
header("Location: customer.php");
exit();
?>
