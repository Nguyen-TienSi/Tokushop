<?php
include ("../database/connectdb.php");
$coupon_id = $_GET['id'];
$sql = "UPDATE coupon SET is_valid = !is_valid WHERE id = $coupon_id";
mysqli_query($conn, $sql);
header("Location: index.php?page=Makhuyenmai");
exit;