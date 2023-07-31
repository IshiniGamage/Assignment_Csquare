<?php
// delete_item.php

// Database connection
include 'connection.php';

// Check if the 'id' parameter is present in the URL
if (isset($_GET['id'])) {
    $item_id = $_GET['id'];

    // Check if the item exists in the database
    $sql = "SELECT * FROM item WHERE id = '$item_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Item exists, proceed with deletion
        $delete_sql = "DELETE FROM item WHERE id = '$item_id'";
        if ($conn->query($delete_sql) === TRUE) {
            $_SESSION['success_message'] = "Item deleted successfully.";
        } else {
            $_SESSION['error_message'] = "Error deleting item: " . $conn->error;
        }
    } else {
        // Item doesn't exist, show a message
        $_SESSION['error_message'] = "Item not found.";
    }
} else {
    // 'id' parameter not found in the URL
    $_SESSION['error_message'] = "Invalid request.";
}

// Close the database connection
$conn->close();

// Redirect back to the 'item.php' page
header("Location: item.php");
exit();
?>
