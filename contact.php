<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact Us - MedicoCare</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #fff;
      color: #000;
      margin: 0;
      padding: 0;
    }

    .navbar {
      background-color: #000;
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      color: white;
      font-weight: bold;
      font-size: 24px;
    }

    .nav-links {
      list-style: none;
      display: flex;
      gap: 20px;
    }

    .nav-links li a {
      text-decoration: none;
      color: white;
      font-weight: 500;
    }

    .nav-links li a:hover {
      text-decoration: underline;
    }

    .contact-container {
      max-width: 800px;
      margin: 50px auto;
      padding: 40px;
      background-color: #f9f9f9;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
    }

    input, textarea {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #333;
      border-radius: 4px;
      font-size: 16px;
    }

    button {
      background-color: #000;
      color: #fff;
      border: none;
      padding: 12px 25px;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #333;
    }

    footer {
      text-align: center;
      padding: 20px;
      background: #000;
      color: #fff;
      margin-top: 40px;
    }
  </style>
</head>
<body>

  <!-- Header / Navbar -->
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

  <!-- Contact Form Section -->
  <div class="contact-container">
    <h1>Contact Us</h1>
    <form action="submit_contact.php" method="POST">
      <input type="text" name="name" placeholder="Your Full Name" required>
      <input type="email" name="email" placeholder="Your Email Address" required>
      <textarea name="message" rows="5" placeholder="Your Message or Inquiry" required></textarea>
      <button type="submit">Send Message</button>
    </form>
  </div>

  <!-- Footer -->
  <footer>
    &copy; 2025 MedicoCare. All rights reserved.
  </footer>

</body>
</html>
