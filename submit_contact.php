<?php
$conn = new mysqli("localhost", "root", "2352005", "medical_shop");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);
$stmt->execute();

echo "<script>alert('✅ Your message has been sent!'); window.location.href='contact.php';</script>";
?>
 