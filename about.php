<?php
session_start();

// Define fixed admin credentials
$admin_username = "admin";
$admin_password = "12345"; // you can change this

$error = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION["admin_logged_in"] = true;
        echo "<script>alert('Welcome Admin!'); window.location.href='admin_dashboard.php';</script>";
        exit();
    } else {
        $error = "❌ Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login | Sai Shopping Center</title>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: 'Poppins', sans-serif;
    background: url('images/admin-bg.jpg') no-repeat center center/cover;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    position: relative;
}

body::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
    z-index: 0;
}

.admin-container {
    position: relative;
    z-index: 1;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 40px 50px;
    width: 400px;
    box-shadow: 0 0 20px rgba(255,255,255,0.2);
    text-align: center;
}

.admin-container img.logo {
    width: 90px;
    height: 90px;
    margin-bottom: 20px;
    border-radius: 50%;
    border: 2px solid #ffeb3b;
    object-fit: cover;
}

.admin-container h2 {
    color: #fff;
    font-size: 26px;
    margin-bottom: 25px;
    text-shadow: 1px 1px 4px rgba(0,0,0,0.4);
}

.admin-container input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    outline: none;
}

.admin-container button {
    width: 100%;
    background: #4B0026;
    color: #fff;
    border: none;
    padding: 12px;
    border-radius: 8px;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 15px;
    transition: 0.3s;
}

.admin-container button:hover {
    background: #7F001A;
    transform: scale(1.03);
}

.error {
    margin-top: 15px;
    color: #ffeb3b;
    font-weight: 600;
}

@media (max-width: 480px) {
    .admin-container { width: 90%; padding: 30px; }
    .admin-container h2 { font-size: 22px; }
}
</style>
</head>
<body>

<div class="admin-container">
    <img src="images/logo.jpeg" alt="Sai Shopping Center Logo" class="logo">
    <h2>Admin Login</h2>

    <form method="POST" action="">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit">Login</button>
    </form>

    <?php if (!empty($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>
</div>

</body>
</html>
