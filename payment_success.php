<?php
require 'includes/db.php';

// ✅ Razorpay response data
$payment_id = $_POST['razorpay_payment_id'] ?? '';
$signature = $_POST['razorpay_signature'] ?? '';
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$contact = $_POST['contact'] ?? '';  // 🛠️ Define properly
$address = $_POST['address'] ?? '';

// ✅ Insert into orderss table
$query = "INSERT INTO orderss (customer_name, email, phone, address, payment_id)
          VALUES ('$name', '$email', '$contact', '$address', '$payment_id')";
$conn->query($query);

echo "✅ Payment Successful!";
?>
