<?php
include("../database/connectdb.php");
$page = $_GET['page'];
$table = $_GET['table'];
$id = $_GET['id'];
$type = $_GET['type'];

$sql = "";
if ($type == 'display') {
    $sql = "UPDATE $table SET is_displayed = !is_displayed WHERE id = $id";
} else {
    $sql = "DELETE FROM $table WHERE id = $id";
}
mysqli_query($conn, $sql);

header("location: index.php?page={$page}&table={$table}");
exit;
