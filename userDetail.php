<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT * FROM user WHERE id='". $_SESSION['id'] . "'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
} elseif (isset($_POST['user-meta'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $sql = "UPDATE user SET name = '$name', phone = '$phone', email = '$email', address = '$address' 
    WHERE id='". $_SESSION['id'] . "'";
    mysqli_query($conn, $sql);
    echo "<script>window.location = 'index.php?page=Thongtincanhan';</script>";
} elseif (isset($_POST['user-account'])) {
    $pass = $_POST['pass'];

    $sql = "UPDATE user SET password='$pass' WHERE id='". $_SESSION['id'] . "'";
    mysqli_query($conn, $sql);
    echo "<script>window.location = 'index.php?page=Thongtincanhan';</script>";
}

echo "<style>";
include("./css/customer/userDetail.css");
echo "</style>";
?>

<div id="user-detail">
    <div>
        <form action="" method="post">
            <h2>Thông tin cá nhân</h2>
            <div class="user-data">
                <p>Họ và tên</p>
                <input type="text" name="name" value="<?= $row['name'] ?>">
            </div>
            <div class="user-data">
                <p>Số điện thoại</p>
                <input type="text" name="phone" value="<?= $row['phone'] ?>">
            </div>
            <div class="user-data">
                <p>Email</p>
                <input type="text" name="email" value="<?= $row['email'] ?>">
            </div>
            <div class="user-data">
                <p>Địa chỉ</p>
                <input type="text" name="address" value="<?= $row['address'] ?>">
            </div>
            <button type="submit" name="user-meta">Lưu</button>
        </form>
    </div>

    <div>
        <form action="" method="post">
            <h2>Tài khoản</h2>
            <div class="user-data">
                <p>Tên đăng nhập</p>
                <input type="text" name="username" value="<?= $row['username'] ?>" disabled>
            </div>
            <div class="user-data">
                <p>Password</p>
                <input type="password" name="pass" value="<?= $row['password'] ?>">
            </div>
            <button type="submit" name="user-account">Đổi mật khẩu</button>
        </form>
    </div>
</div>