<?php
if (isset($_GET['Tukhoa'])) {
    $products = getProductByKeyWord($_GET['Tukhoa'], true);
} else {
    $products = getProduct($id = "", $all = true, $order = true);
}
$page_number = isset($_GET['index']) ? $_GET['index'] : 1;
$result_per_page = 6;
$start_from = ($page_number - 1) * $result_per_page;
$number_of_result = count($products);
$total_pages = ceil($number_of_result / $result_per_page);
$products = array_slice($products, $start_from, $result_per_page);

echo "<style>";
include("../css/admin/productList.css");
echo "</style>";
?>

<div class="search">
    <input type="text" id="searchInput" placeholder="Nhập từ khóa tìm kiếm">
    <button onclick="searchProduct()">Tìm kiếm</button>
</div>

<div>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Ngày nhập</th>
                <th>Số lượng</th>
                <th>Dòng sản phẩm</th>
                <th>Tình trạng</th>
                <th>Ẩn/Hiện</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $index => $product) { ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><img src="../uploaded-img/product/<?= $product['represent_img'] ?>" /></td>
                    <td><?= $product['product_name'] ?></td>
                    <td><?= $product['price'] ?></td>
                    <td><?= $product['import_date'] ?></td>
                    <td><?= $product['quantity'] ?></td>
                    <td><?= $product['category1_name'] ?></td>
                    <td><?= $product['category2_name'] ?></td>
                    <td><?= ($product['is_displayed'] ? 'Đang hiển thị' : 'Ẩn') ?></td>
                    <td>
                        <button class="edit"><a href="index.php?page=Chitietsanpham&id=<?= $product['id'] ?>">Sửa</a></button>
                        <button class="delete"><a href="deleteProduct.php?id=<?= $product['id'] ?>">Xoá</a></button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div id="pagination">
    <?php
    if ($page_number > 1) {
        echo "<a href='index.php?page=Sanpham&index=" . ($page_number - 1) . "'><button class='move-btn'>&#10094;</button></a>";
    }

    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='index.php?page=Sanpham&index=" . $i . "'><button class='" . ($i == $page_number ? 'active' : '') . "'>$i</button></a>";
    }

    if ($page_number < $total_pages) {
        echo "<a href='index.php?page=Sanpham&index=" . ($page_number + 1) . "'><button class='move-btn'>&#10095;</button></a>";
    }
    ?>
</div>

<script>
    function searchProduct() {
        var searchInput = document.getElementById('searchInput');
        var searchValue = searchInput.value.trim();
        
        if (searchValue !== "") {
            window.location.href = 'index.php?page=Sanpham&Tukhoa=' + encodeURIComponent(searchValue);
        }
    }
</script>