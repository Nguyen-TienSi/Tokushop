<?php
session_start();
include("../database/connectdb.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $pass = $_POST['pass'];

    if (!empty($username) && !empty($pass)) {
        $sql = "SELECT * FROM user WHERE username='$username' AND password='$pass' AND role='admin' AND is_locked=0";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $row['id'];
            header("Location: index.php");
            exit;
        }
    }
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

        #loginForm {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            width: 30%;
            height: 400px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s
        }

        /* Add Animation */
        @-webkit-keyframes animatetop {
            from {
                top: -300px;
                opacity: 0
            }

            to {
                top: 0;
                opacity: 1
            }
        }

        @keyframes animatetop {
            from {
                top: -300px;
                opacity: 0
            }

            to {
                top: 0;
                opacity: 1
            }
        }

        h2 {
            text-transform: uppercase;
        }

        a {
            color: black;
        }

        form {
            width: 100%;
            text-align: center;
        }

        .user-input {
            display: flex;
            align-items: center;
            position: relative;
            margin: 15px;
        }

        .user-input input {
            width: 80%;
            padding: 10px 15px;
            margin: auto;
        }

        button {
            width: 30%;
            padding: 10px 0;
        }

        .pass-icon {
            position: absolute;
            right: 30px;
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div id="loginForm">
        <h2>Đăng nhập</h2>
        <form action="" method="post">
            <div class="user-input">
                <input type="text" name="username" placeholder="Tên đăng nhập">
            </div>
            <div class="user-input">
                <input type="password" name="pass" placeholder="Mật khẩu">
                <img src="../assets/pass-hide.png" onclick="showPassword(this)" class="pass-icon">
            </div>
            <button name="loginBtn" type="submit">Đăng nhập</button>
        </form>
        <p>------Hoặc------</p>
        <a href="register.php">Đăng ký tại đây</a>
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