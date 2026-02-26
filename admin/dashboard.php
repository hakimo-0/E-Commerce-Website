<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
include '../api/db.php';

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM products WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: dashboard.php"); exit;
}

$result = mysqli_query($conn, "SELECT id, main_img, name, brand, price FROM products ORDER BY created_at DESC");
$total = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <title>Dashboard - KIMO SHOP</title>
    <style>
        *{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',sans-serif}
        body{background:#f4f6f9;min-height:100vh}
        .navbar{background:#fff;padding:0 30px;height:65px;display:flex;justify-content:space-between;align-items:center;box-shadow:0 2px 10px rgba(0,0,0,0.08)}
        .navbar h2{color:#12d0d6;font-size:20px}
        .nav-links a{text-decoration:none;color:#555;font-size:14px;font-weight:600;margin-left:20px;transition:.3s}
        .nav-links a:hover{color:#12d0d6}
        .nav-links a.logout{background:#e74c3c;color:#fff;padding:7px 16px;border-radius:6px}
        .nav-links a.logout:hover{background:#c0392b}
        .container{padding:30px;max-width:1200px;margin:0 auto}
        .stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;margin-bottom:30px}
        .stat-card{background:#fff;padding:25px;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,0,0.08);display:flex;align-items:center;gap:15px}
        .stat-icon{width:50px;height:50px;background:#12d0d6;color:#fff;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:24px}
        .stat-info h3{font-size:28px;color:#333;margin-bottom:5px}
        .stat-info p{color:#999;font-size:13px}
        .header-section{background:#fff;padding:25px;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,0,0.08);display:flex;justify-content:space-between;align-items:center;margin-bottom:20px}
        .header-section h3{color:#333;font-size:18px}
        .add-btn{background:#12d0d6;color:#fff;padding:12px 24px;border-radius:8px;text-decoration:none;font-size:14px;font-weight:600;transition:.3s}
        .add-btn:hover{background:#088178}
        .products-table{background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 10px rgba(0,0,0,0.08)}
        table{width:100%;border-collapse:collapse}
        th{background:#f8f9fa;padding:16px;text-align:left;font-size:13px;font-weight:600;color:#555;border-bottom:2px solid #e9ecef}
        td{padding:16px;border-bottom:1px solid #f1f3f5;color:#333;font-size:14px}
        tr:hover{background:#f8f9fa}
        .product-img{width:50px;height:50px;object-fit:cover;border-radius:8px}
        .actions a{text-decoration:none;padding:6px 12px;border-radius:6px;font-size:13px;font-weight:600;margin-right:8px;transition:.3s;display:inline-block}
        .edit{background:#3498db;color:#fff}
        .edit:hover{background:#2980b9}
        .delete{background:#e74c3c;color:#fff}
        .delete:hover{background:#c0392b}
        .empty{text-align:center;padding:60px;color:#999}
        .empty-icon{font-size:64px;margin-bottom:15px;opacity:.3}
    </style>
</head>
<body>
<div class="navbar">
    <h2>🛒 KIMO Admin Dashboard</h2>
    <div class="nav-links">
        <a href="../index.php" target="_blank">View Store</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>
</div>

<div class="container">
    <div class="stats">
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-box-open"></i></div>
            <div class="stat-info">
                <h3><?= $total ?></h3>
                <p>Total Products</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-square-check"></i></div>
            <div class="stat-info">
                <h3><?= $total ?></h3>
                <p>Active</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-user"></i></div>
            <div class="stat-info">
                <h3>0</h3>
                <p>Orders Today</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-sack-dollar"></i></div>
            <div class="stat-info">
                <h3>$0</h3>
                <p>Revenue</p>
            </div>
        </div>
    </div>

    <div class="header-section">
        <h3><i class="fa-solid fa-clipboard-list"></i> Products Management</h3>
        <a href="add-product.php" class="add-btn">+ Add New Product</a>
    </div>

    <div class="products-table">
        <?php if ($total > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td>
                        <?php if ($row['main_img']): ?>
                        <img src="../<?= htmlspecialchars($row['main_img']) ?>" alt="product" class="product-img">
                        <?php else: ?>
                        <div style="width:50px;height:50px;background:#eee;border-radius:8px"></div>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['brand']) ?></td>
                    <td>$<?= number_format($row['price'], 2) ?></td>
                    <td class="actions">
                        <a href="edit-product.php?id=<?= $row['id'] ?>" class="edit"><i class="fa-solid fa-pen"></i> Edit</a>
                        <a href="?delete=<?= $row['id'] ?>" class="delete" onclick="return confirm('Do you want to delete this product?')"><i class="fa-regular fa-trash-can"></i> Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="empty">
            <div class="empty-icon">📦</div>
            <h3>Makaynch products!</h3>
            <p>Zid product jdid bach tbda.</p>
            <br>
            <a href="add-product.php" class="add-btn">+ Add First Product</a>
        </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>