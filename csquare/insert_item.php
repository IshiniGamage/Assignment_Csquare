<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_code = $_POST["item_code"];
    $item_name = $_POST["item_name"];
    $item_category = $_POST["item_category"];
    $item_subcategory = $_POST["item_subcategory"];
    $quantity = $_POST["quantity"];
    $unit_price = $_POST["unit_price"];

    // Insert item data into the 'item' table
    $sql = "INSERT INTO item (item_code, item_name, item_category, item_subcategory, quantity, unit_price)
            VALUES ('$item_code', '$item_name', '$item_category', '$item_subcategory', '$quantity', '$unit_price')";

    if ($conn->query($sql) === TRUE) {
        // After successful insertion, redirect back to item.php
        header("Location: item.php");
        exit(); // Make sure to exit to avoid any unexpected output
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
session_start();
$_SESSION['success_message'] = "Item added successfully.";

// Redirect back to the "Item Page"
header("Location: item_page.php");
$conn->close();
?>
