<?php
if (!empty($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
} elseif (!empty($_SESSION['fake_id'])) {
    $user_id = $_SESSION['fake_id'];
} else {
    $_SESSION['fake_id'] = uniqid();
    $user_id = $_SESSION['fake_id'];
}

$product_id = $_GET['id'];
$product = getProduct($product_id, $all = true, $order = false);
$imgs = explode(', ', $product[0]['otherImgs']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quantity = $_POST['quantity'];

    $sql = "SELECT * FROM cart 
            WHERE (user_id = '$user_id' OR fake_user_id = '$user_id') AND product_id = '$product_id'";
    $result = mysqli_query($conn, $sql);
    $cart_data = mysqli_fetch_assoc($result);

    if ($cart_data) {
        if ($product[0]['quantity'] >= $cart_data['quantity'] + $quantity) {
            $sql = "UPDATE cart SET quantity = quantity + $quantity 
                WHERE (user_id = '$user_id' OR fake_user_id = '$user_id') AND product_id = '$product_id'";
        }
    } else {
        $user_column = !empty($_SESSION['id']) ? "user_id" : "fake_user_id";
        $sql = "INSERT INTO cart ($user_column, product_id, quantity, choose_date) 
                VALUES ('$user_id', '$product_id', '$quantity', NOW())";
    }

    mysqli_query($conn, $sql);

    echo "<script>window.location = 'index.php?page=Chitietsanpham&id={$product_id}'</script>";
}

echo "<style>";
include("./css/customer/productItem.css");
echo "</style>";
?>

<div id="primary-detail">
    <div id="gallery">
        <div id="main-img">
            <?php echo "<img src='uploaded-img/product/{$product[0]['represent_img']}'/>" ?>
        </div>
        <!-- <?php if ($imgs) { ?> -->
            <div>
                <button onclick="prevImg()">
                    <p>&#10094;</p>
                </button>
                <div id="img-collection">
                    <?php foreach ($imgs as $img) {
                        echo "<img src='uploaded-img/product/{$img}'/>";
                    } ?>
                </div>
                <button onclick="nextImg()">
                    <p>&#10095;</p>
                </button>
            </div>
        <!-- <?php } ?> -->
    </div>
    <div id="meta-data">
        <h2><?= $product[0]['product_name'] ?></h2>
        <p><span>Dòng sản phẩm: </span><?= $product[0]['category1_name'] ?></p>
        <p><span>Tình trạng: </span><?= $product[0]['category2_name'] ?></p>
        <p><span>Giá sản phẩm: </span><?= $product[0]['price'] ?></p>
        <p><span>Số lượng: </span><?= $product[0]['quantity'] ?></p>

        <form action="" method="post">
            <button type="button" onclick="quantityHandler(this, '-')">-</button>
            <input type="number" name="quantity" value="1">
            <button type="button" onclick="quantityHandler(this, '+')">+</button>
            <button type="submit">Thêm vào giỏ hàng</button>
        </form>
        <div id="description">
            <h3>Thông tin sản phẩm</h3>
            <pre><?= $product[0]['description'] ?></pre>
        </div>
    </div>
</div>

<script src="./js/customer/productItem.js"></script>
<script>
    function quantityHandler(button, operation) {
        const input = button.parentElement.querySelector('input[type="number"]');
        if (operation === "+" && <?= $product[0]['quantity'] ?> > parseInt(input.value)) {
            input.value = parseInt(input.value) + 1;
        } else if (operation === "-" && parseInt(input.value) > 1)
            input.value = parseInt(input.value) - 1;
    }
</script>