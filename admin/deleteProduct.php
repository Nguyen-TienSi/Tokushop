<?php
include ("../database/connectdb.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM product WHERE id=$id";
    mysqli_query($conn, $sql);
}
header("location: ./index.php?page=Sanpham");
exit();
?>