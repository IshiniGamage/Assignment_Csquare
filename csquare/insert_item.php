<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_code = $_POST["item_code"];
    $item_name = $_POST["item_name"];
    $item_category = $_POST["item_category"];
    $item_subcategory = $_POST["item_subcategory"];
    $quantity = $_POST["quantity"];
    $unit_price = $_POST["unit_price"];

    $sql = "INSERT INTO item (item_code, item_name, item_category, item_subcategory, quantity, unit_price)
            VALUES ('$item_code', '$item_name', '$item_category', '$item_subcategory', '$quantity', '$unit_price')";

    if ($conn->query($sql) === TRUE) {
        header("Location: item.php");
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
session_start();
$_SESSION['success_message'] = "Item added successfully.";

header("Location: item_page.php");
$conn->close();
?>
