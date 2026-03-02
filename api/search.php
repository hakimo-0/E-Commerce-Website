<?php
// api/search.php
// Search endpoint - returns JSON results

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include 'db.php';

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

if (strlen($q) < 2) {
    echo json_encode([]);
    exit;
}

// Sanitize
$q_safe = mysqli_real_escape_string($conn, $q);

// Search in name, brand, description
$sql = "SELECT id, name, brand, price, main_img 
        FROM products 
        WHERE name LIKE '%$q_safe%' 
           OR brand LIKE '%$q_safe%' 
           OR description LIKE '%$q_safe%'
        ORDER BY 
            CASE WHEN name LIKE '$q_safe%' THEN 0 ELSE 1 END,
            name ASC
        LIMIT 8";

$result = mysqli_query($conn, $sql);

$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = [
        'id'       => $row['id'],
        'name'     => $row['name'],
        'brand'    => $row['brand'],
        'price'    => $row['price'],
        'main_img' => $row['main_img'],
    ];
}

echo json_encode($products);
?>