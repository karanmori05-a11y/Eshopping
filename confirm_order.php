<?php
// Initialize errors array
$errors = [];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $address = trim($_POST['address']);

    // Validate Name (letters and spaces only)
    if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $errors[] = "Name can only contain letters and spaces.";
    }

    // Validate Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate Address
    if (empty($address)) {
        $errors[] = "Address cannot be empty.";
    }

    // If no errors, redirect to thankyou.php
    if (empty($errors)) {
        header("Location: thankyou.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Confirm Order | Sai Shopping Center</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }

body {
    font-family:'Poppins',sans-serif;
    background: url('images/login-bg.jpeg') no-repeat center center fixed; /* background image */
    background-size: cover;
    min-height:100vh;
    padding-top:80px;
    color:#4B0026;
}

/* Header */
header {
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 40px;
    background: rgba(75,0,38,0.9);
    position:fixed;
    top:0;
    left:0;
    width:100%;
    z-index:1000;
    box-shadow:0 2px 6px rgba(0,0,0,0.3);
}
header img.logo { height:55px; border-radius:8px; }
header nav { display:flex; gap:25px; }
header nav a {
    color:#fff;
    text-decoration:none;
    font-weight:bold;
    transition:0.3s;
}
header nav a:hover { color:#FFD1DC; }

/* Form Container */
.form-container {
    max-width:500px;
    margin:100px auto;
    background: rgba(255, 255, 255, 0.85);
    padding:30px;
    border-radius:15px;
    box-shadow:0 6px 20px rgba(0,0,0,0.15);
}
h2 {
    text-align:center;
    margin-bottom:20px;
    color:#4B0026;
}
form label {
    display:block;
    margin:12px 0 5px;
    font-weight:bold;
}
form input, form textarea {
    width:100%;
    padding:10px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:14px;
}
form button {
    margin-top:15px;
    padding:10px 20px;
    font-size:16px;
    cursor:pointer;
    border:none;
    border-radius:8px;
    background:#4B0026;
    color:#fff;
    font-weight:bold;
    transition:0.3s;
}
form button:hover { background:#7F001A; }
.error {
    color:red;
    margin-bottom:15px;
    font-weight:bold;
    text-align:center;
}
</style>
</head>
<body>

<header>
    <h2 style="display:flex;align-items:center;gap:10px;">
        <img src="images/logo.jpeg" alt="Logo" class="logo"> Sai Shopping Center
    </h2>
    <nav>
        <a href="categories.php">Categories</a>
        <a href="#" onclick="alert('About Us content here')">About Us</a>
        <a href="#" onclick="alert('Contact info here')">Contact Us</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<div class="form-container">
    <h2>Confirm Your Order</h2>

    <?php if(!empty($errors)): ?>
        <div class="error">
            <?php foreach($errors as $err) echo $err."<br>"; ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" placeholder="Enter your name" required
            value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">

        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Enter your email" required
            value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">

        <label for="address">Address</label>
        <textarea name="address" id="address" rows="3" placeholder="Enter your address" required><?php echo isset($address) ? htmlspecialchars($address) : ''; ?></textarea>

        <button type="submit">Confirm Order</button>
    </form>
</div>

</body>
</html>
