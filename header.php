<?php

$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<style>
.navbar {
    background: #6c63ff;
    padding: 10px 20px;
    display: flex;
    justify-content: flex-end;
    gap: 20px;
}
.navbar a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
}
.navbar a:hover {
    text-decoration: underline;
}
</style>

<div class="navbar">
    <a href="about.php">About Us</a>
    <a href="contact.php">Contact Us</a>
    <a href="login.php">Login</a>
    <a href="cart.php">Cart 🛒 (<?php echo $cart_count; ?>)</a>
</div>
