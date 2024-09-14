<?php
if (isset($_POST['loginBtn'])) {
    $username = $_POST['username'];
    $pass = $_POST['pass'];

    if (!empty($username) && !empty($pass)) {
        $sql = "SELECT * FROM user WHERE username='$username' AND password='$pass' AND role='customer' AND is_locked=0";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $row['id'];
            if (isset($_SESSION['fake_id'])) {
                unset($_SESSION['fake_id']);
            }
            echo "<script>window.location = 'index.php';</script>";
        }
    }
}

echo "<style>";
include("./css/customer/login.css");
echo "</style>";
?>

<div id="modalLogin">
    <div id="loginForm">
        <span id="closeBtn">&times;</span>
        <h2>Đăng nhập</h2>
        <form action="" method="post">
            <div class="user-input">
                <input type="text" name="username" placeholder="Tên đăng nhập">
            </div>
            <div class="user-input">
                <input type="password" name="pass" placeholder="Mật khẩu">
                <img src="./assets/pass-hide.png" onclick="showPassword(this)" class="pass-icon">
            </div>
            <button name="loginBtn" type="submit">Đăng nhập</button>
        </form>
        <p>------Hoặc------</p>
        <a href="index.php?page=Dangky">Đăng ký tại đây</a>
    </div>
</div>

<script>
    const modal = document.getElementById("modalLogin");
    const login = document.getElementById("person");

    login.onclick = function() {
        <?php if (!$logged_in) { ?>
            modal.style.display = "block";
        <?php } ?>
    }

    const clostBtn = document.getElementById("closeBtn");

    clostBtn.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    function showPassword(img) {
        const input = img.previousElementSibling;
        if (input.type === 'password') {
            input.type = 'text';
            img.src = './assets/pass-show.png';
        } else {
            input.type = 'password';
            img.src = './assets/pass-hide.png';
        }
    }
</script>