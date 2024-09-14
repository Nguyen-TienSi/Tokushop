<?php
include("../database/connectdb.php");
$id = $_GET['id'];
$order_state = 'Đã hủy';
$sql = "UPDATE `order` SET order_state='$order_state' WHERE id = '$id'";
mysqli_query($conn, $sql);
header("Location: index.php?page=Donhang");
exit;