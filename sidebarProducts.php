<?php
$category1 = getCategory('category1');
$category2 = getCategory('category2');

echo "<style>";
include("./css/customer/sidebarProducts.css");
echo "</style>";
?>

<div class="main-sidebar">
    <div class="category">
        <h3>Dòng sản phẩm</h3>
        <div class="title">
            <?php foreach ($category1 as $category) { ?>
                <?php if ($category['category_name'] == 'Khác') {
                    echo "<a href='index.php?page=Sanpham'>Tất cả</a>";
                    continue;
                } ?>
                <a href="index.php?page=Sanpham&Tukhoa=<?= $category['category_name'] ?>"><?= $category['category_name'] ?></a>
            <?php } ?>
        </div>
    </div>
    <div class="category">
        <h3>Tình trạng sản phẩm</h3>
        <div class="title">
            <?php foreach ($category2 as $category) { ?>
                <a href="index.php?page=Sanpham&Tukhoa=<?= $category['category_name'] ?>"><?= $category['category_name'] ?></a>
            <?php } ?>
        </div>
    </div>
</div>