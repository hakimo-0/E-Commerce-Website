<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "kimoshop";
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die(json_encode(["error" => "Connection failed: " . mysqli_connect_error()]));
}
mysqli_set_charset($conn, "utf8");
?>