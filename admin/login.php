<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['username'] === 'admin' && $_POST['password'] === 'admin123') {
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "The username or password is incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <title>Admin Login - KIMO SHOP</title>
    <style>
        *{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',sans-serif}
        body{background:linear-gradient(135deg,#465b52,#088178);display:flex;justify-content:center;align-items:center;height:100vh}
        .box{background:#fff;padding:40px;border-radius:16px;box-shadow:0 10px 40px rgba(0,0,0,0.2);width:380px}
        .logo{text-align:center;margin-bottom:25px}
        .logo h2{color:#12d0d6;font-size:26px}
        .logo p{color:#999;font-size:13px;margin-top:5px}
        input{width:100%;padding:12px 16px;margin-bottom:14px;border:1.5px solid #ddd;border-radius:8px;font-size:14px;transition:.3s}
        input:focus{border-color:#12d0d6;outline:none}
        button{width:100%;padding:13px;background:#12d0d6;color:#fff;border:none;border-radius:8px;font-size:15px;font-weight:700;cursor:pointer;transition:.3s}
        button:hover{background:#088178}
        .error{background:#ffe0e0;color:#c0392b;padding:10px;border-radius:6px;font-size:13px;margin-bottom:14px;text-align:center}
    </style>
</head>
<body>
<div class="box">
    <div class="logo">
        <h2> KIMO Admin</h2>
        <p>Panel dyal gestion des produits</p>
    </div>
    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="👤 Username" required>
        <input type="password" name="password" placeholder="🔒 Password" required>
        <button type="submit">Login →</button>
    </form>
</div>
</body>
</html>