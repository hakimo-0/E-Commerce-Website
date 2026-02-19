<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
include 'db.php';
$result = mysqli_query($conn, "SELECT * FROM products ORDER BY created_at DESC");
$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}
echo json_encode($products);
?>