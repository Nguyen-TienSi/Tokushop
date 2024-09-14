<?php
$page = $_GET['page'];
$table = $_GET['table'];
$categoryList = [];
$categoryList = getCategory($table, false);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = $_POST['category_name'];
    $state = $_POST['state'];

    $sql = "INSERT INTO $table (category_name, is_displayed) VALUES ('$category_name', '$state')";
    mysqli_query($conn, $sql);

    header("Location: index.php?page={$page}&table={$table}");
    exit;
}

echo "<style>";
include("../css/admin/categories.css");
echo "</style>";
?>

<form action="" method="post">
    <input type="text" name="category_name" placeholder="Nhập tên danh mục mới">
    <input type="radio" id="display" name="state" value="1">
    <label for="display">Hiển thị</label>
    <input type="radio" id="hide" name="state" value="0">
    <label for="hide">Ẩn</label>
    <button type="submit">Lưu</button>
</form>
<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên danh mục</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categoryList as $index => $category) { ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $category['category_name'] ?></td>
                <td><?= ($category['is_displayed'] ? 'Đang hiển thị' : 'Đang ẩn') ?></td>
                <?php
                echo "
                        <td>
                            <a href='processCategory.php?page={$page}&table={$table}&id={$category['id']}&type=display'><button>Ẩn/Hiện</button></a>
                            <a href='processCategory.php?page={$page}&table={$table}&id={$category['id']}&type=delete'><button id='delete'>Xóa</button></a>
                        </td>
                    "; ?>
            </tr>
        <?php } ?>
    </tbody>
</table>