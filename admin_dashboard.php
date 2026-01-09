<?php
session_start();
include 'db.php';

// ================== LOGOUT HANDLER ==================
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin_login.php");
    exit();
}

// Redirect if admin not logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// ================== HANDLE ORDER STATUS UPDATE ==================
if (isset($_POST['update_status'])) {
    $order_id = intval($_POST['order_id']);
    $status = $_POST['status'];
    $conn->query("UPDATE orders SET status='$status' WHERE order_id=$order_id");
}

// ================== FETCH ALL ORDERS WITH USER + PRODUCT DETAILS ==================
$query = "
SELECT 
    o.order_id, o.total_amount, o.status, o.order_date,
    u.name AS user_name, u.email,
    GROUP_CONCAT(CONCAT(p.product_name, ' (x', oi.quantity, ')') SEPARATOR ', ') AS products
FROM orders o
JOIN users u ON o.user_id = u.user_id
JOIN order_items oi ON o.order_id = oi.order_id
JOIN products p ON oi.product_id = p.product_id
GROUP BY o.order_id
ORDER BY o.order_id DESC
";
$orders = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard | Sai Shopping Center</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body {
    font-family:'Poppins',sans-serif;
    background: url('images/admin-bg.jpeg') no-repeat center center/cover;
    min-height:100vh;
    color:#fff;
    display:flex;
    flex-direction:column;
    align-items:center;
}
header {
    background: rgba(0,0,0,0.7);
    width:100%;
    padding:20px 0;
    text-align:center;
    font-size:26px;
    font-weight:600;
    box-shadow:0 4px 10px rgba(0,0,0,0.3);
}
.dashboard-container {
    margin-top:40px;
    background: rgba(0,0,0,0.65);
    padding:30px;
    border-radius:15px;
    width:90%;
    max-width:1300px;
    box-shadow:0 0 20px rgba(255,255,255,0.2);
}
h2 { text-align:center; margin-bottom:15px; }
table {
    width:100%;
    border-collapse:collapse;
    text-align:center;
    margin-top:10px;
}
th, td {
    padding:12px;
    border-bottom:1px solid rgba(255,255,255,0.2);
}
th { background: rgba(255,255,255,0.1); font-size:16px; text-transform:uppercase; }
td { font-size:15px; }
select { padding:6px 10px; border-radius:5px; border:none; outline:none; font-weight:bold; }
button {
    padding:6px 12px;
    background:#ffeb3b;
    color:#4B0026;
    font-weight:600;
    border:none;
    border-radius:6px;
    cursor:pointer;
    transition:0.3s;
}
button:hover { background:#fff; }
.logout-btn {
    margin:25px 0;
    background:#4B0026;
    color:#fff;
    padding:12px 25px;
    border-radius:10px;
    font-size:16px;
    font-weight:bold;
    text-decoration:none;
    transition:0.3s;
}
.logout-btn:hover { background:#7F001A; }
@media (max-width:768px){
    .dashboard-container { padding:20px; }
    table th, table td { font-size:13px; padding:8px; }
}
</style>
</head>
<body>

<header>🛍️ Sai Shopping Center — Admin Dashboard</header>

<!-- ================= ORDERS TABLE ================= -->
<div class="dashboard-container">
    <h2>📦 All Orders</h2>
    <table>
        <tr>
            <th>Order ID</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Products (Name × Qty)</th>
            <th>Total (₹)</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php if ($orders && $orders->num_rows > 0): ?>
            <?php while($row = $orders->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['order_id'] ?></td>
                    <td><?= htmlspecialchars($row['user_name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['products']) ?></td>
                    <td><?= number_format($row['total_amount'], 2) ?></td>
                    <td><?= $row['order_date'] ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="order_id" value="<?= $row['order_id'] ?>">
                            <select name="status">
                                <option value="pending" <?= $row['status']=='pending'?'selected':'' ?>>Pending</option>
                                <option value="completed" <?= $row['status']=='completed'?'selected':'' ?>>Completed</option>
                            </select>
                    </td>
                    <td><button type="submit" name="update_status">Update</button></td>
                        </form>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="8">No orders found!</td></tr>
        <?php endif; ?>
    </table>
</div>

<!-- ================= LOGOUT ================= -->
<a href="?logout=1" class="logout-btn">Logout</a>

</body>
</html>
