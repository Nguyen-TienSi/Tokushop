<?php
if (isset($_GET['Tukhoa'])) {
    $products = getProductByKeyWord($_GET['Tukhoa']);
} else {
    $products = getProduct();
}

$page_number = isset($_GET['index']) ? $_GET['index'] : 1;
$result_per_page = 6;
$start_from = ($page_number - 1) * $result_per_page;
$number_of_result = count($products);
$total_pages = ceil($number_of_result / $result_per_page);
$products = array_slice($products, $start_from, $result_per_page);

echo "<style>";
include("./css/customer/products.css");
echo "</style>";
?>

<section>
    <?php include("sidebarProducts.php"); ?>

    <div class="product-collection">
        <div id="product-list">
            <?php foreach ($products as $product) { ?>
                <div class="product-item">
                    <a href="index.php?page=Chitietsanpham&id=<?= $product['id'] ?>">
                        <img class="product-image" src="uploaded-img/product/<?= $product['represent_img'] ?>" />
                        <div>
                            <h2 class="product-name"><?= $product['product_name'] ?></h2>
                            <h3 class="product-price"><?= $product['price'] ?> VNĐ</h3>
                        </div>
                    </a>
                </div>
            <?php } ?>
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
    </div>
</section>