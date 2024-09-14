<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "tokushop";

$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function getCategory($table, $getDisplayed = true)
{
    global $conn;
    if ($getDisplayed) $sql = "SELECT * FROM $table WHERE is_displayed=1";
    else $sql = "SELECT * FROM $table";
    $result = mysqli_query($conn, $sql);

    $category_data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $category_data[] = $row;
    }

    return $category_data;
}

function getProduct($id = "", $all = false, $order = true)
{
    global $conn;
    $sql = "SELECT product.*, category1.category_name AS category1_name, category2.category_name AS category2_name
            FROM product 
            LEFT JOIN category1 ON category1.id = product.category1_id
            LEFT JOIN category2 ON category2.id = product.category2_id";
            
    if (!$all) $sql .= " WHERE product.is_displayed=1 AND product.quantity > 0";
    if (!empty($id)) $sql .= " WHERE product.id = $id";
    if ($order) $sql .= " ORDER BY product.import_date DESC";
    $result = mysqli_query($conn, $sql);
    $product_data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $product_data[] = $row;
    }
    return $product_data;
}

function getProductByKeyWord($keyword, $all = false)
{
    global $conn;
    $sql = "SELECT product.*, category1.category_name AS category1_name, category2.category_name AS category2_name 
            FROM product 
            LEFT JOIN category1 ON category1.id = product.category1_id
            LEFT JOIN category2 ON category2.id = product.category2_id
            WHERE product.product_name LIKE '%$keyword%' 
            OR category1.category_name LIKE '%$keyword%' 
            OR category2.category_name LIKE '%$keyword%'";
    if (!$all) {
        $sql .= " AND product.quantity > 0 AND product.is_displayed = 1";
    }
    $sql .= " ORDER BY product.import_date DESC";
    $result = mysqli_query($conn, $sql);
    $product_data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $product_data[] = $row;
    }
    return $product_data;
}

function uploadImg($img_name, $img_tmp_name, $dir)
{
    $img_name = basename($img_name);
    $path = $dir . $img_name;
    if (file_exists($path)) return;
    move_uploaded_file($img_tmp_name, $path);
}
