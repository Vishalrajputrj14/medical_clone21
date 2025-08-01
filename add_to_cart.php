<?php
// DB connection
$conn = new mysqli("localhost", "root", "2352005", "medical_shop");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if all GET parameters are present
if (isset($_GET['id']) && isset($_GET['name']) && isset($_GET['price'])) {
    // Clean input
    $product_id = (int)$_GET['id'];
    $name = urldecode($_GET['name']);
    $price = (float)$_GET['price'];

    // Check if item already exists in cart
    $stmt = $conn->prepare("SELECT id FROM cart WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update quantity
        $update = $conn->prepare("UPDATE cart SET quantity = quantity + 1 WHERE product_id = ?");
        $update->bind_param("i", $product_id);
        $update->execute();
    } else {
        // Insert new item
        $insert = $conn->prepare("INSERT INTO cart (product_id, name, price, quantity) VALUES (?, ?, ?, 1)");
        $insert->bind_param("isd", $product_id, $name, $price);
        $insert->execute();
    }

    // Redirect to cart
    header("Location: cart.php");
    exit();
} else {
    echo "❌ Error: Missing data in URL.";
}
?>
