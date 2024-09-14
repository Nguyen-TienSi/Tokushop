<?php
$slideList = [];

$sql = "SELECT * FROM slideshow";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $slideList[] = $row;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $title = $_POST['title'];
    $state = $_POST['state'];
    $img_name = $_FILES['img']['name'];
    $img_tmp_name =  $_FILES['img']['tmp_name'];
    $dir = "../uploaded-img/slideshow/";
    uploadImg($img_name, $img_tmp_name, $dir);

    $sql = "INSERT INTO slideshow (img, title, is_displayed) VALUES ('$img_name', '$title', '$state')";
    mysqli_query($conn, $sql);

    header("location: index.php?page=Slideshow");
    exit();
}
?>

<style>
    form {
        padding: 20px;
    }

    div {
        margin: 10px;
    }

    input[type="text"] {
        padding: 5px 16px;
        width: 50%;
        font-size: 16px;
    }

    table {
        width: 70%;
        border-collapse: collapse;
        margin: 20px auto;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }

    img {
        max-width: 50px;
        max-height: 50px;
    }

    form>button, td button {
        padding: 5px 10px;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
    }
</style>

<form action="" method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Tên slide show">
    <input type="file" name="img">
    <div>
        <input type="radio" id="display" name="state" value="1">
        <label for="display">Hiển thị</label>
        <input type="radio" id="hide" name="state" value="0">
        <label for="hide">Ẩn</label>
    </div>
    <button type="submit">Lưu</button>
</form>
<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Hình ảnh</th>
            <th>Tiêu đề</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($slideList as $index => $slide) { ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><img style="width: 50px; height: 50px" src="../uploaded-img/slideshow/<?= $slide['img'] ?>" /></td>
                <td><?= $slide['title'] ?></td>
                <td><?= $slide['is_displayed'] ? "Đang hiển thị" : "Đang ẩn" ?></td>
                <td>
                    <a href="processSlideshow.php?id=<?= $slide['id'] ?>&type=display"><button>Ẩn/Hiện</button></a>
                    <a href="processSlideshow.php?id=<?= $slide['id'] ?>&type=delete"><button>Xóa</button></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>