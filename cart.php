<?php
// DB Connection
$conn = new mysqli("localhost", "root", "2352005", "medical_shop");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Cart - MedicoCare</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .navbar {
      background: black;
      color: white;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .navbar .logo {
      font-size: 24px;
      font-weight: bold;
    }
    .nav-links {
      list-style: none;
      display: flex;
      gap: 20px;
    }
    .nav-links li a {
      color: white;
      text-decoration: none;
    }
    .container {
      max-width: 800px;
      margin: 40px auto;
      background: white;
      padding: 30px;
      border-radius: 8px;
    }
    .cart-item {
      border-bottom: 1px solid #ccc;
      padding: 15px 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .btn {
      background: red;
      color: white;
      padding: 8px 15px;
      text-decoration: none;
      border-radius: 5px;
    }
    .total {
      text-align: right;
      font-size: 18px;
      margin-top: 20px;
      font-weight: bold;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<header>
  <nav class="navbar">
    <div class="logo">🩺 MedicoCare</div>
    <ul class="nav-links">
      <li><a href="index.html">Home</a></li>
      <li><a href="medicines.html">Medicines</a></li>
      <li><a href="cart.php">Cart</a></li>
      <li><a href="contact.php">Contact</a></li>
    </ul>
  </nav>
</header>

<!-- Cart Section -->
<div class="container">
  <h1>Your Shopping Cart 🛒</h1>

  <?php
  $total = 0;
  $sql = "SELECT * FROM cart";
  $result = $conn->query($sql);

  if ($result->num_rows > 0):
      while($item = $result->fetch_assoc()):
          $subtotal = $item['price'] * $item['quantity'];
          $total += $subtotal;
  ?>
      <div class="cart-item">
        <div>
          <h3><?= htmlspecialchars($item['name']) ?></h3>
          <p>Qty: <?= $item['quantity'] ?> | ₹<?= number_format($item['price'], 2) ?> each</p>
          <p>Subtotal: ₹<?= number_format($subtotal, 2) ?></p>
        </div>
        <a href="remove_from_cart.php?id=<?= $item['id'] ?>" class="btn">❌ Remove</a>
      </div>
  <?php endwhile; ?>
      <div class="total">Total: ₹<?= number_format($total, 2) ?></div>
      <br>
      <a href="checkout.php" class="btn" style="background:green;">Proceed to Checkout ➡️</a>
  <?php else: ?>
      <p>Your cart is empty.</p>
  <?php endif; ?>

</div>

</body>
</html>
