<?php
// ✅ Database connection
$conn = new mysqli("localhost", "root", "2352005", "medical_shop");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ✅ Check if 'id' is passed
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize input

    // ✅ Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM cart WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// ✅ Redirect back to cart
header("Location: cart.php");
exit();
?>
