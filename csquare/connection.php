<?php
$servername = "localhost";
$username = "root";
$password = "Gamage@1998";
$dbname = "csquare";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
