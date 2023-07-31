<?php

include 'connection.php';

if (isset($_GET['id'])) {
    $item_id = $_GET['id'];

    // Check if the item  in the database
    $sql = "SELECT * FROM item WHERE id = '$item_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $delete_sql = "DELETE FROM item WHERE id = '$item_id'";
        if ($conn->query($delete_sql) === TRUE) {
            $_SESSION['success_message'] = "Item deleted successfully.";
        } else {
            $_SESSION['error_message'] = "Error deleting item: " . $conn->error;
        }
    } else {
        $_SESSION['error_message'] = "Item not found.";
    }
} else {
    $_SESSION['error_message'] = "Invalid request.";
}

$conn->close();

header("Location: item.php");
exit();
?>
