<?php
include("../database/connectdb.php");
$id = $_GET['id'];
$type = $_GET['type'];

$sql = "";
if ($type == 'display') {
    $sql = "UPDATE slideshow SET is_displayed = !is_displayed WHERE id = $id";
} else {
    $sql = "DELETE FROM slideshow WHERE id = $id";
}
mysqli_query($conn, $sql);

header("location: index.php?page=Slideshow");
exit;
