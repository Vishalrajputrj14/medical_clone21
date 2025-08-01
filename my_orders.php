<?php
$conn = new mysqli("localhost", "root", "2352005", "medical_shop");
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

// You can get this from session or user login in future
$user_email = "yogesh13singhrajput@gmail.com"; // TEMPORARY: Replace with dynamic session later

// Get all orders for this email
$order_result = $conn->query("SELECT * FROM orders WHERE email = '$user_email' ORDER BY created_at DESC");

?>

<!DOCTYPE html>
<html>
<head>
  <title>My Orders - MedicoCare</title>
  <style>
    body {
      font-family: Arial;
      background: #f9f9f9;
      padding: 30px;
    }
    .order-box {
      background: white;
      margin-bottom: 30px;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .order-box h3 {
      margin-top: 0;
      color: #000;
    }
    .items-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    .items-table th, .items-table td {
      padding: 8px 12px;
      border: 1px solid #ccc;
      text-align: left;
    }
    .items-table th {
      background: #000;
      color: white;
    }
  </style>
</head>
<body>

  <h1>🧾 My Orders</h1>

  <?php while ($order = $order_result->fetch_assoc()): ?>
    <div class="order-box">
      <h3>Order #<?= $order['id'] ?> | ₹<?= $order['total_amount'] ?> | <?= $order['created_at'] ?></h3>
      <p><strong>Name:</strong> <?= $order['customer_name'] ?> | <strong>Email:</strong> <?= $order['email'] ?></p>
      <p><strong>Address:</strong> <?= $order['address'] ?></p>

      <?php
        $order_id = $order['id'];
        $items = $conn->query("SELECT * FROM order_items WHERE order_id = $order_id");
      ?>

      <table class="items-table">
        <tr>
          <th>Medicine</th>
          <th>Quantity</th>
          <th>Price</th>
        </tr>
        <?php while ($item = $items->fetch_assoc()): ?>
          <tr>
            <td><?= $item['item_name'] ?></td>
            <td><?= $item['qty'] ?></td>
            <td>₹<?= $item['price'] ?></td>
          </tr>
        <?php endwhile; ?>
      </table>
    </div>
  <?php endwhile; ?>

</body>
</html>
