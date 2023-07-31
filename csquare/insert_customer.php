<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $contact_number = $_POST["contact_number"];
    $district = $_POST["district"];

    $sql = "INSERT INTO customers (title, first_name, last_name, contact_number, district)
            VALUES ('$title', '$first_name', '$last_name', '$contact_number', '$district')";

    if ($conn->query($sql) === TRUE) {
        echo "Customer data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
