<?php
session_start();
// if (isset($_SESSION['id'])) {
//   header("Location: login.php");
//   exit;
// }

if (isset($_GET['logout'])) {
  session_unset();
  session_destroy();
  header("Location: login.php");
  exit();
}

include("../database/connectdb.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="../css/admin/index.css" />
</head>

<body>
  <aside class="sidebar">
    <h2 id="logo">TOKUSHOP</h2>
    <nav class="main-menu">
      <ul>
        <!-- <li class="nav-item"><a href="index.php">Dashboard</a></li> -->
        <li class="nav-item">
          <button>Quản lý sản phẩm</button>
          <ul class="menu-group">
            <li><a href="index.php?page=Sanpham">Sản phẩm</a></li>
            <li><a href="index.php?page=Chitietsanpham">Thêm sản phẩm</a></li>
            <li><a href="index.php?page=Danhmuc1&table=category1">Danh mục cấp 1</a></li>
            <li><a href="index.php?page=Danhmuc2&table=category2">Danh mục cấp 2</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="index.php?page=Slideshow">Slideshow</a>
        </li>
        <!-- <li class="nav-item">
          <a>Danh sách bài viết</a>
        </li>
        <li class="nav-item">
          <a>Danh sách feedback</a>
        </li> -->
        <li class="nav-item">
          <a href="index.php?page=Makhuyenmai">Mã khuyến mãi</a>
        </li>
        <li class="nav-item">
          <button>Thông tin khách hàng</button>
          <ul class="menu-group">
            <li><a href="index.php?page=Taikhoan">Tài khoản</a></li>
            <li><a href="index.php?page=Donhang">Tình trạng đơn hàng</a></li>
            <li><a href="index.php?page=Yeucauhotro">Yêu cầu hỗ trợ</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="index.php?logout">Đăng xuất</a>
        </li>
      </ul>
    </nav>
  </aside>

  <main id="main-section">
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : "";

    switch ($page) {
      case "Sanpham":
        include "productList.php";
        break;
      case "Chitietsanpham":
        include "productItem.php";
        break;
      case "Danhmuc1":
        include "categories.php";
        break;
      case "Danhmuc2":
        include "categories.php";
        break;
      case "Slideshow":
        include "slideshow.php";
        break;
      case "Makhuyenmai":
        include "coupon.php";
        break;
      case "Taikhoan":
        include "account.php";
        break;
      case "Donhang":
        include "orders.php";
        break;
      case "Chitietdonhang":
        include "orderDetail.php";
        break;
      case "Yeucauhotro":
        include "contact.php";
        break;
        // default:
        //   include "dashboard.php";
        //   break;
      default:
        include "productList.php";
        break;
    }
    ?>
  </main>

  <!-- <script src="../js/admin/index.js"></script> -->
  <script>
    var buttons = document.querySelectorAll(".nav-item button");
    buttons.forEach(button => {
      button.addEventListener("click", () => {
        var subMenu = button.nextElementSibling;
        subMenu.classList.toggle("show");
      });
    });
  </script>
</body>

</html>