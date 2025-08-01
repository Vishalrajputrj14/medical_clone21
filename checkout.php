<?php
// DB connection
$conn = new mysqli("localhost", "root", "2352005", "medical_shop");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Always calculate total before HTML
$total = 0.00;
$sql = "SELECT * FROM cart";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($item = $result->fetch_assoc()) {
        $total += $item['price'] * $item['quantity'];
    }
}

// Place order on form submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = $conn->real_escape_string($_POST['name']);
    $email         = $conn->real_escape_string($_POST['email']);
    $address       = $conn->real_escape_string($_POST['address']);

    if ($total > 0) {
        // Insert order
        $insert = "INSERT INTO orders (customer_name, email, address, total_amount)
                   VALUES ('$customer_name', '$email', '$address', '$total')";
        if ($conn->query($insert)) {
            $conn->query("DELETE FROM cart");
            echo "<script>alert('✅ Order Placed Successfully!'); window.location.href='index.html';</script>";
            exit();
        } else {
            echo "<script>alert('❌ Order Failed: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('❌ Cart is empty.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Checkout - MedicoCare</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 <style>
  body {
    font-family: 'Roboto', sans-serif;
    background: #f2f2f2;
    margin: 0; /* ✅ remove default margin */
    padding: 0;
  }

  .navbar {
    background: #000;
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
    margin: 0;
    padding: 0;
  }

  .nav-links li a {
    color: white;
    text-decoration: none;
    font-weight: 500;
  }

  .checkout-container {
    max-width: 600px;
    margin: 20px auto; /* ✅ reduced margin from 40px to 20px */
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  }

  h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #333;
  }

  input, textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
  }

  .total {
    font-size: 18px;
    font-weight: bold;
    text-align: right;
    margin-top: 10px;
    color: #000;
  }

  .btn {
    background: #00e6e6;
    color: #000;
    border: none;
    padding: 14px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 6px;
    width: 100%;
    cursor: pointer;
    transition: background 0.3s;
  }

  .btn:hover {
    background: #00cccc;
  }

  @media (max-width: 480px) {
    .navbar {
      flex-direction: column;
      align-items: flex-start;
    }

    .nav-links {
      flex-direction: column;
      gap: 10px;
      margin-top: 10px;
    }

    .checkout-container {
      margin: 20px;
      padding: 20px;
    }
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

<!-- Checkout Form -->
<div class="checkout-container">
  <h2>Checkout 🧾</h2>
  <form method="POST">
    <input type="text" name="name" placeholder="Full Name" required />
    <input type="email" name="email" placeholder="Email Address" required />
    <textarea name="address" rows="3" placeholder="Delivery Address" required></textarea>

    <div class="total">Total: ₹<?= number_format($total, 2) ?></div>

    <button type="submit" class="btn">Place Order (₹<?= number_format($total, 2) ?>)</button>
  </form>
</div>

</body>
</html>
