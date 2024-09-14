<?php
$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
$sql = "SELECT id, name, email FROM user WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['request'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $request = $_POST['request'];

        if (empty($user_id)) $sql = "INSERT INTO contact (name, email, request) VALUES ('$name', '$email', '$request')";
        else $sql = "INSERT INTO contact (name, email, user_id, request) VALUES ('$name', '$email', '$user_id', '$request')";
        mysqli_query($conn, $sql);

        echo "<script>window.location = 'index.php?page=Lienhe';</script>";
    }
}
?>

<style>
    #contact-form {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    #contact-form h2 {
        margin-top: 0;
        margin-bottom: 10px;
    }

    #contact-form span, #contact-form label {
        font-weight: bold;
    }

    #contact-form input[type="text"],
    #contact-form textarea {
        width: 100%;
        padding: 8px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    #contact-form textarea {
        resize: none;
        field-sizing: content;
        min-height: calc(24px * 4);
    }

    #contact-form button {
        padding: 8px 16px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    #contact-form button:hover {
        background-color: #45a049;
    }
</style>

<form action="" method="post" id="contact-form">
    <h2>Thông tin liên hệ</h2>
    <p><span>Địa chỉ:</span> Q12, TPHCM</p>
    <p><span>Hotline:</span> Nhóm 3</p>
    <div>
        <label>Họ và tên</label>
        <input type="text" name="name" value="<?= isset($row['name']) ? $row['name'] : '' ?>">
    </div>
    <div>
        <label>Email</label>
        <input type="text" name="email" value="<?= isset($row['email']) ? $row['email'] : '' ?>">
    </div>
    <div>
        <label>Yêu cầu của bạn</label>
        <textarea name="request" id=""></textarea>
    </div>
    <button type="submit">Gửi</button>
</form>