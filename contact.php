<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (empty($email) || empty($message)) {
        echo "<script>alert('Please fill all fields.'); window.history.back();</script>";
        exit();
    }

    // Optional: store in database (example table 'contact_messages')
    /*
    $stmt = $conn->prepare("INSERT INTO contact_messages (email, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $message);
    if($stmt->execute()) {
        echo "<script>alert('Message sent successfully!'); window.location.href='contact.php';</script>";
    } else {
        echo "<script>alert('Error sending message.'); window.history.back();</script>";
    }
    $stmt->close();
    */

    // For now, just show a success alert
    echo "<script>alert('Message sent successfully!'); window.location.href='contact.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Contact Us</title>
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #e6e6fa, #f8f0ff);
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
.contact-box {
    background: #ffffff;
    padding: 40px 50px;
    width: 500px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}
.contact-box h2 {
    color: #6a5acd;
    margin-bottom: 20px;
    text-align: center;
}
.contact-box label {
    display: block;
    margin-bottom: 5px;
    color: #4b3f72;
    font-weight: bold;
}
.contact-box input,
.contact-box textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #d3cce3;
    border-radius: 8px;
    background-color: #faf8ff;
}
.contact-box button {
    width: 100%;
    padding: 12px;
    background: #a18cd1;
    border: none;
    border-radius: 8px;
    color: white;
    font-size: 16px;
    cursor: pointer;
}
.contact-box button:hover {
    background: #7f6bb2;
}
.back-btn {
    margin-top: 10px;
    padding: 10px 20px;
    background: #a18cd1;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}
.back-btn:hover {
    background: #7f6bb2;
}
</style>
</head>
<body>

<div class="contact-box">
    <h2>Contact Us</h2>
    <form action="contact.php" method="POST">
        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Message:</label>
        <textarea name="message" rows="5" required></textarea>

        <button type="submit">Send Message</button>
    </form>
    <button class="back-btn" onclick="window.history.back()">Go Back</button>
</div>

</body>
</html>
