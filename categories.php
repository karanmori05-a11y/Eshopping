<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sai Shopping Center | Categories</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }

/* Body */
body {
    font-family:'Poppins',sans-serif;
    background: url('images/login-bg.jpeg') no-repeat center center/cover;
    background-size: cover;
    height:100vh;
    color:#222;
}

/* Header */
header {
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 40px;
    background: rgba(255,255,255,0.9);
    position:fixed;
    width:100%;
    z-index:10;
    box-shadow:0 2px 6px rgba(0,0,0,0.15);
}

header img.logo {
    height:50px;
}

header nav a {
    color:#222;
    text-decoration:none;
    font-weight:bold;
    margin-left:25px;
    transition:0.3s;
}
header nav a:hover { color:#800020; } /* wine color on hover */

/* Container */
.container {
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    gap:50px;
    padding-top:100px; /* header offset */
}

/* Category cards */
.category-card {
    width:250px;
    height:350px;
    border-radius:15px;
    background: rgba(255,255,255,0.95);
    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    text-align:center;
    cursor:pointer;
    transition: transform 0.3s, box-shadow 0.3s;
}
.category-card:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 30px rgba(0,0,0,0.25);
}

.category-card img {
    width:150px;
    height:150px;
    object-fit:cover;
    border-radius:50%;
    margin-bottom:20px;
    border:3px solid #222;
}

.category-card h3 { font-size:24px; color:#800020; font-weight:bold; }

/* Modals */
.modal {
    display:none;
    position:fixed;
    top:0; left:0;
    width:100%; height:100%;
    background: rgba(0,0,0,0.6);
    justify-content:center;
    align-items:center;
    z-index:20;
}
.modal-content {
    background: #fff;
    padding:30px 40px;
    border-radius:15px;
    color:#222;
    width:80%;
    max-width:500px;
    text-align:center;
    position:relative;
    box-shadow: 0 8px 24px rgba(0,0,0,0.2);
}
.modal-content h2 { margin-bottom:15px; color:#800020; }
.close-btn {
    position:absolute;
    top:15px;
    right:20px;
    font-size:20px;
    cursor:pointer;
    color:#222;
}
</style>
</head>
<body>

<header>
    <img src="images/logo.jpeg" alt="Logo" class="logo">
    <nav>
        <a href="#" onclick="openModal('intro')">Introduction</a>
        <a href="#" onclick="openModal('about')">About Us</a>
        <a href="#" onclick="openModal('contact')">Contact Us</a>
    </nav>
</header>

<div class="container">
    <!-- Men Category -->
    <div class="category-card" onclick="location.href='subcategories.php?category=men'">
        <img src="images/men.jpeg" alt="Men Category">
        <h3>Men</h3>
    </div>
    <!-- Women Category -->
    <div class="category-card" onclick="location.href='subcategories.php?category=women'">
        <img src="images/women.jpeg" alt="Women Category">
        <h3>Women</h3>
    </div>
</div>

<!-- Modals -->
<div class="modal" id="intro">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal('intro')">&times;</span>
        <h2>Introduction</h2>
        <p>Welcome to Sai Shopping Center! Explore our wide range of products for men and women, carefully curated to meet your style and quality needs.</p>
    </div>
</div>

<div class="modal" id="about">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal('about')">&times;</span>
        <h2>About Us</h2>
        <p>Sai Shopping Center has been serving customers with the best fashion and lifestyle products since 2025. Our mission is to provide quality products at affordable prices.</p>
    </div>
</div>

<div class="modal" id="contact">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal('contact')">&times;</span>
        <h2>Contact Us</h2>
        <p>Email: support@sai-shopping.com<br>Phone: +91 1234567890<br>Address: 123 Fashion Street, City, India</p>
    </div>
</div>

<script>
function openModal(id){ document.getElementById(id).style.display="flex"; }
function closeModal(id){ document.getElementById(id).style.display="none"; }
</script>

</body>
</html>
