<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle quantity update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_quantity'])) {
        $index = (int)$_POST['index'];
        $action = $_POST['action'];

        if (isset($_SESSION['cart'][$index])) {
            if ($action === 'plus') {
                $_SESSION['cart'][$index]['quantity']++;
            } elseif ($action === 'minus' && $_SESSION['cart'][$index]['quantity'] > 1) {
                $_SESSION['cart'][$index]['quantity']--;
            }
        }
    }

    // Handle removing item
    if (isset($_POST['remove_item'])) {
        $index = (int)$_POST['index'];
        if (isset($_SESSION['cart'][$index])) {
            array_splice($_SESSION['cart'], $index, 1);
        }
    }
}

// Calculate total price and total quantity
$totalPrice = 0;
$totalQuantity = 0;
foreach ($_SESSION['cart'] as $item) {
    $totalPrice += $item['price'] * $item['quantity'];
    $totalQuantity += $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cart | Sai Shopping Center</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }

body {
    font-family: 'Poppins', sans-serif;
    background: url('images/login-bg.jpeg') no-repeat center center fixed;
    background-size: cover;
    min-height: 100vh;
    color: #4B0026;
    padding-top: 100px;
}

/* Header */
header {
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 40px;
    background: rgba(75,0,38,0.95);
    color:#fff;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    z-index:1000;
    box-shadow:0 2px 8px rgba(0,0,0,0.3);
}
header img.logo { height:55px; border-radius:8px; }
header nav { display:flex; gap:25px; }
header nav a { color:#fff; text-decoration:none; font-weight:bold; transition:0.3s; }
header nav a:hover { color:#FFD1DC; }

/* Page Title */
.page-title {
    text-align:center;
    margin-bottom:30px;
    font-size:30px;
    font-weight:700;
    color:#4B0026;
}

/* Cart Container */
.cart-container {
    max-width:1000px;
    margin:0 auto;
    padding:20px;
    background: rgba(255, 255, 255, 0.85); /* transparent white for readability */
    border-radius:15px;
    box-shadow:0 6px 20px rgba(0,0,0,0.15);
}

table {
    width:100%;
    border-collapse:collapse;
}
th, td {
    padding:12px;
    text-align:center;
    border-bottom:1px solid #ccc;
}
th { background:#4B0026; color:#fff; }
img.product-img { width:80px; height:80px; object-fit:cover; border-radius:8px; }

/* Buttons */
form.inline { display:inline-block; }
button {
    padding:6px 10px;
    background:#4B0026;
    color:#fff;
    border:none;
    border-radius:5px;
    cursor:pointer;
    font-weight:bold;
    transition:0.3s;
}
button:hover { background:#7F001A; }

/* Order Summary */
.order-summary {
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(255,255,255,0.85);
    padding:20px 30px;
    border-radius:15px;
    box-shadow:0 6px 20px rgba(0,0,0,0.15);
    max-width:400px;
    text-align:center;
}
.order-summary h3 { margin-bottom:15px; color:#4B0026; }
.order-summary p { margin:10px 0; font-weight:bold; font-size:16px; }
.order-summary button {
    margin-top:15px;
    padding:10px 20px;
    font-size:16px;
    border:none;
    border-radius:8px;
    background:#4B0026;
    color:#fff;
    font-weight:bold;
    transition:0.3s;
}
.order-summary button:hover { background:#7F001A; }

@media (max-width:768px){
    header { flex-direction:column; gap:10px; text-align:center; }
    table, th, td { font-size:12px; }
    img.product-img { width:50px; height:50px; }
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

<div class="page-title">🛍️ Your Cart</div>

<div class="cart-container">
<?php if(!empty($_SESSION['cart'])): ?>
<table>
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
        <th>Action</th>
    </tr>
    <?php foreach($_SESSION['cart'] as $index => $item): ?>
    <tr>
        <td><img src="images/<?= htmlspecialchars($item['image']) ?>" class="product-img"></td>
        <td><?= htmlspecialchars($item['name']) ?></td>
        <td>₹<?= htmlspecialchars($item['price']) ?></td>
        <td>
            <form method="post" class="inline">
                <input type="hidden" name="index" value="<?= $index ?>">
                <input type="hidden" name="action" value="minus">
                <button type="submit" name="update_quantity">-</button>
            </form>
            <?= $item['quantity'] ?>
            <form method="post" class="inline">
                <input type="hidden" name="index" value="<?= $index ?>">
                <input type="hidden" name="action" value="plus">
                <button type="submit" name="update_quantity">+</button>
            </form>
        </td>
        <td>₹<?= $item['price'] * $item['quantity'] ?></td>
        <td>
            <form method="post">
                <input type="hidden" name="index" value="<?= $index ?>">
                <button type="submit" name="remove_item">Remove</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
    <p style="text-align:center; font-size:18px;">Your cart is empty.</p>
<?php endif; ?>
</div>

<?php if(!empty($_SESSION['cart'])): ?>
<div class="order-summary">
    <h3>Order Summary</h3>
    <p>Total Quantity: <?= $totalQuantity ?></p>
    <p>Total Price: ₹<?= $totalPrice ?></p>
    <form action="confirm_order.php" method="get">
        <button type="submit">Confirm Order</button>
    </form>
</div>
<?php endif; ?>

</body>
</html>
