<?php
include("../database/connectdb.php");
$id = $_GET['id'];
$sql = "UPDATE user SET is_locked = !is_locked WHERE id=$id";
mysqli_query($conn, $sql);

header("Location: index.php?page=Taikhoan");
exit;