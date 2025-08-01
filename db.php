<?php
$conn = new mysqli("localhost", "root", "2352005", "medical_shop");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
