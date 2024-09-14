<?php 
include("./database/connectdb.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    * {
      font-family: Arial, Helvetica, sans-serif;
      text-decoration: none;
    }

    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: 0;
    }

    footer {
      background-color: #333;
      color: white;
      /* display: block;
    clear: both; */
      width: 100%;
      margin-top: auto;
    }
  </style>
</head>

<body>
  <?php include("header.php"); ?>

  <main>
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : "";

    switch ($page) {
      case 'Dangky':
        include("register.php");
        break;
      case 'Sanpham':
        include("products.php");
        break;
      case 'Chitietsanpham':
        include("productItem.php");
        break;
      case 'Lienhe':
        include("contact.php");
        break;
      case 'Giohang':
        include("cart.php");
        break;
      case 'Thongtincanhan':
        include("userDetail.php");
        break;
      case 'Thongtinmuahang':
        include("orders.php");
        break;
      case 'Chitietdonhang':
        include("orderDetail.php");
        break;
      default:
        include("home.php");
        break;
    }
    ?>
  </main>

  <footer>
    <?php include("footer.php"); ?>
  </footer>
</body>

</html>