<?php
$logged_in = !empty($_SESSION['id']);

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

echo "<style>";
include("./css/customer/header.css");
echo "</style>";
?>

<header>
    <a href="index.php" id="logo">
        <img src="assets/Logo_Bandai.svg.png" alt="" />
        <h1>Tokushop</h1>
    </a>

    <div id="searchInput">
        <input type="text" placeholder="Tên sản phẩm" />
        <button onclick="search(this)"><img src="./assets/search.png" alt=""></button>
    </div>

    <div id="customerInfo">
        <div id="cart">
            <a href="index.php?page=Giohang"><img src="./assets/shoppingCart.png" alt="">Giỏ hàng</a>
        </div>
        <div id="access-info">
            <div id="person">
                <img src="./assets/personIcon.png" alt=""><span></span>
            </div>
            <div id="dropdown">
                <p><a href="index.php?page=Thongtincanhan"><span>Trang cá nhân</span><span>&#10095;</span></a></p>
                <p><a href="index.php?page=Thongtinmuahang"><span>Thông tin mua hàng</span><span>&#10095;</span></a></p>
                <p><a id="logout" href="index.php?logout"><span>Đăng xuất</span><span>&#10095;</span></a></p>
            </div>
        </div>
    </div>
</header>

<nav class="navbar">
    <ul>
        <li><a href="index.php">TRANG CHỦ</a></li>
        <li><a href="index.php?page=Sanpham">TẤT CẢ SẢN PHẨM</a></li>
        <li><a href="">VỀ CHÚNG TÔI</a></li>
        <!-- <li><a href="">TIN TỨC</a></li> -->
        <li><a href="index.php?page=Lienhe">LIÊN HỆ</a></li>
    </ul>
</nav>

<script>
    function search(button) {
        if (button.parentElement.querySelector('input').value != "") {
            window.location = 'index.php?page=Sanpham&Tukhoa=' + button.parentElement.querySelector('input').value;
        }
    }

    <?php if ($logged_in) { ?>
        document.querySelector("#person span").textContent = "Tài khoản";
        const dropdown = document.getElementById("dropdown");
        document.getElementById("access-info").addEventListener("mouseover", () => {
            dropdown.style.display = "block";
        });
        document.getElementById("access-info").addEventListener("mouseout", () => {
            dropdown.style.display = "none";
        });
    <?php } else { ?>
        document.querySelector("#person span").textContent = "Đăng nhập";
    <?php } ?>
</script>

<?php include("login.php") ?>