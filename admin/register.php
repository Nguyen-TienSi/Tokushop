<?php
session_start();
include ("../database/connectdb.php");
$error_msg = isset($_GET['error']) ? $_GET['error'] : "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $repass = $_POST['repass'];

    if (!empty($username) && !empty($pass) && !empty($repass)) {
        $sql = "SELECT username FROM user";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            if ($username == $row['username']) {
                $error_msg = "Tên đăng nhập đã được sử dụng";
                break;
            }
        }

        if ($repass != $pass && empty($error_msg)) {
            $error_msg = "Mật khẩu không trùng khớp";
        }

        if (empty($error_msg)) {
            $sql = "INSERT INTO user (username, password, role, is_locked) 
                VALUES ('$username', '$pass', 'admin', 0)";
            mysqli_query($conn, $sql);

            $_SESSION['id'] = mysqli_insert_id($conn);
            header("Location: index.php");
            exit;
        }
    } else {
        $error_msg = "Vui lòng nhập đầy đủ thông tin";
    }
    header("Location: register.php?error=" . urlencode($error_msg));
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        #registerForm {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            background-color: #fefefe;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        h2 {
            text-transform: uppercase;
            margin-bottom: 0;
        }

        form {
            width: 100%;
            text-align: center;
        }

        button {
            width: 30%;
            padding: 10px 0;
        }

        .user-input {
            position: relative;
            margin-bottom: 10px;
        }

        .user-input input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .pass-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div id="registerForm">
        <h2>Đăng ký</h2>
        <?php
        if (!empty($error_msg)) {
            echo htmlspecialchars($error_msg);
        }
        ?>
        <form action="" method="post">
            <div class="user-input">
                <input type="text" name="username" placeholder="Tên đăng nhập">
            </div>
            <div class="user-input">
                <input type="password" name="pass" placeholder="Mật khẩu">
                <img src="../assets/pass-hide.png" onclick="showPassword(this)" class="pass-icon">
            </div>
            <div class="user-input">
                <input type="password" name="repass" placeholder="Nhập lại mật khẩu">
                <img src="../assets/pass-hide.png" onclick="showPassword(this)" class="pass-icon">
            </div>

            <button type="submit">Đăng ký</button>
        </form>
    </div>

    <script>
        function showPassword(img) {
            const input = img.previousElementSibling;
            if (input.type === 'password') {
                input.type = 'text';
                img.src = '../assets/pass-show.png';
            } else {
                input.type = 'password';
                img.src = '../assets/pass-hide.png';
            }
        }
    </script>
</body>

</html>