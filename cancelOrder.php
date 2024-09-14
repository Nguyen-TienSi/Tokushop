<?php
include("./database/connectdb.php");
$id = $_GET['id'];
$sql = "DELETE FROM order_item WHERE order_id = '$id'";
mysqli_query($conn, $sql);
$sql = "DELETE FROM `order` WHERE id = '$id'";
mysqli_query($conn, $sql);

header("Location: index.php?page=Thongtinmuahang");
exit;