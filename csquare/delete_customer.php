<?php

include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM customers WHERE customer_id = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $delete_sql = "DELETE FROM customers WHERE customer_id = '$id'";
        if ($conn->query($delete_sql) === TRUE) {
            $_SESSION['success_message'] = "Customer deleted successfully.";
        } else {
            $_SESSION['error_message'] = "Error deleting customer: " . $conn->error;
        }
    } else {
        $_SESSION['error_message'] = "Customer not found.";
    }
} else {
    $_SESSION['error_message'] = "Invalid request.";
}

$conn->close();

header("Location: customer.php");
exit();
?>
