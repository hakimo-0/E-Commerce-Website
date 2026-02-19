<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
include '../api/db.php';
$success = ""; $error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name        = mysqli_real_escape_string($conn, $_POST['name']);
    $brand       = mysqli_real_escape_string($conn, $_POST['brand']);
    $price       = floatval($_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $main_img    = mysqli_real_escape_string($conn, $_POST['main_img']);
    $thumb1      = mysqli_real_escape_string($conn, $_POST['thumb1']);
    $thumb2      = mysqli_real_escape_string($conn, $_POST['thumb2']);
    $thumb3      = mysqli_real_escape_string($conn, $_POST['thumb3']);
    $thumb4      = mysqli_real_escape_string($conn, $_POST['thumb4']);
    $sql = "INSERT INTO products (name,brand,price,description,main_img,thumb1,thumb2,thumb3,thumb4)
            VALUES ('$name','$brand','$price','$description','$main_img','$thumb1','$thumb2','$thumb3','$thumb4')";
    if (mysqli_query($conn, $sql)) { $success = "Product zdat b njah! ✅"; }
    else { $error = "Khata: " . mysqli_error($conn); }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product - KIMO</title>
    <style>
        *{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',sans-serif}
        body{background:#f4f6f9}
        .navbar{background:#fff;padding:0 30px;height:65px;display:flex;justify-content:space-between;align-items:center;box-shadow:0 2px 10px rgba(0,0,0,0.08)}
        .navbar h2{color:#12d0d6}
        .navbar a{color:#555;text-decoration:none;font-weight:600;font-size:14px}
        .navbar a:hover{color:#12d0d6}
        .container{max-width:620px;margin:40px auto;background:#fff;padding:35px;border-radius:14px;box-shadow:0 2px 10px rgba(0,0,0,0.08)}
        h3{margin-bottom:25px;color:#333;font-size:18px}
        .form-group{margin-bottom:16px}
        label{font-size:13px;font-weight:600;color:#555;display:block;margin-bottom:6px}
        input,textarea{width:100%;padding:11px 14px;border:1.5px solid #ddd;border-radius:8px;font-size:14px;transition:.3s}
        input:focus,textarea:focus{border-color:#12d0d6;outline:none}
        textarea{height:80px;resize:vertical}
        .thumbs{display:grid;grid-template-columns:1fr 1fr;gap:12px}
        button{background:#12d0d6;color:#fff;padding:13px 28px;border:none;border-radius:8px;font-size:14px;font-weight:700;cursor:pointer;transition:.3s;margin-top:5px}
        button:hover{background:#088178}
        .success{background:#e0f7f4;color:#088178;padding:12px;border-radius:8px;margin-bottom:16px;font-weight:600}
        .error{background:#ffe0e0;color:#c0392b;padding:12px;border-radius:8px;margin-bottom:16px;font-weight:600}
        .back{color:#12d0d6;text-decoration:none;font-size:13px;margin-top:12px;display:inline-block}
    </style>
</head>
<body>
<div class="navbar">
    <h2>🛍️ KIMO Admin</h2>
    <a href="dashboard.php">← Dashboard</a>
</div>
<div class="container">
    <h3>➕ Add New Product</h3>
    <?php if ($success) echo "<div class='success'>$success</div>"; ?>
    <?php if ($error)   echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
        <div class="form-group"><label>Product Name *</label><input type="text" name="name" placeholder="ex: Men's Fashion T-Shirt" required></div>
        <div class="form-group"><label>Brand</label><input type="text" name="brand" placeholder="ex: adidas"></div>
        <div class="form-group"><label>Price ($) *</label><input type="number" name="price" step="0.01" placeholder="ex: 69.00" required></div>
        <div class="form-group"><label>Description</label><textarea name="description" placeholder="Product description..."></textarea></div>
        <div class="form-group"><label>Main Image Path</label><input type="text" name="main_img" placeholder="ex: product/f1.jpg"></div>
        <div class="form-group">
            <label>Thumbnails</label>
            <div class="thumbs">
                <input type="text" name="thumb1" placeholder="Thumb 1: product/f1.jpg">
                <input type="text" name="thumb2" placeholder="Thumb 2: product/f2.jpg">
                <input type="text" name="thumb3" placeholder="Thumb 3: product/f3.jpg">
                <input type="text" name="thumb4" placeholder="Thumb 4: product/f4.jpg">
            </div>
        </div>
        <button type="submit">✅ Add Product</button>
    </form>
    <a href="dashboard.php" class="back">← Back to Dashboard</a>
</div>
</body>
</html>