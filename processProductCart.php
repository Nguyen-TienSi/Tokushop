<?php
session_start();
include('./database/connectdb.php');

if (!empty($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
} elseif (!empty($_SESSION['fake_id'])) {
    $user_id = $_SESSION['fake_id'];
} else {
    $_SESSION['fake_id'] = uniqid();
    $user_id = $_SESSION['fake_id'];
}

$product_id = $_GET['productId'];
$type = $_GET['type'];
$product = getProduct($product_id, $all = true, $order = false);

$sql = "SELECT quantity FROM cart 
        WHERE (user_id = '$user_id' OR fake_user_id = '$user_id') AND product_id = '$product_id'";
$result = mysqli_fetch_assoc(mysqli_query($conn, $sql));

if ($type == 'plus' && $product[0]['quantity'] > $result['quantity']) {
    $sql = "UPDATE cart SET quantity = quantity + 1 WHERE (user_id = '$user_id' OR fake_user_id = '$user_id') AND product_id = '$product_id'";
} elseif ($type == 'minus' && $result['quantity'] > 1) {
    $sql = "UPDATE cart SET quantity = quantity - 1 WHERE (user_id = '$user_id' OR fake_user_id = '$user_id') AND product_id = '$product_id'";
} elseif ($type == 'delete') {
    $sql = "DELETE FROM cart WHERE (user_id = '$user_id' OR fake_user_id = '$user_id') AND product_id = '$product_id'";
}

mysqli_query($conn, $sql);

header('location: index.php?page=Giohang');
exit;
