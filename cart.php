<?php
if (!empty($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
} elseif (!empty($_SESSION['fake_id'])) {
    $user_id = $_SESSION['fake_id'];
} else {
    $_SESSION['fake_id'] = uniqid();
    $user_id = $_SESSION['fake_id'];
}
$products = [];
$coupons = [];

$sql = "SELECT cart.*, product.product_name, product.price, product.represent_img, product.quantity AS product_quantity
        FROM cart 
        LEFT JOIN product ON cart.product_id = product.id
        WHERE (cart.user_id = '$user_id' OR cart.fake_user_id = '$user_id')";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

$sql = "SELECT name, phone, email, address FROM user WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM coupon WHERE is_valid = 1";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $coupons[] = $row;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $note = $_POST['note'];
    $total = $_POST['total'];

    $order_state = 'Chờ xác nhận';
    if (!empty($_SESSION['id'])) {
        $sql = "INSERT INTO `order` (user_id, name, phone, email, address, note, create_date, order_state, total) 
                VALUES ('$user_id', '$name', '$phone', '$email', '$address', '$note', NOW(), '$order_state', '$total')";
    } else {
        $sql = "INSERT INTO `order` (name, phone, email, address, note, create_date, order_state, total) 
                VALUES ('$name', '$phone', '$email', '$address', '$note', NOW(), '$order_state', '$total')";
    }
    mysqli_query($conn, $sql);

    // Lấy ID của đơn hàng vừa tạo
    $order_id = mysqli_insert_id($conn);

    // Thêm dữ liệu vào bảng `order_item` cho từng sản phẩm trong giỏ hàng
    foreach ($products as $product) {
        $product_id = $product['product_id'];
        $quantity = $product['quantity'];
        $sql = "INSERT INTO order_item (order_id, product_id, quantity) VALUES ('$order_id', '$product_id', '$quantity')";
        mysqli_query($conn, $sql);

        $sql = "SELECT * FROM cart WHERE product_id = '$product_id'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['quantity'] > $quantity) {
                $sql = "UPDATE cart SET quantity = quantity - '$quantity' 
                        WHERE (user_id = '{$row['user_id']}' OR fake_user_id = '{$row['fake_user_id']}') AND product_id = '{$row['product_id']}'";
            } else {
                $sql = "DELETE FROM cart 
                        WHERE (user_id = '{$row['user_id']}' OR fake_user_id = '{$row['fake_user_id']}') AND product_id = '{$row['product_id']}'";
            }
            mysqli_query($conn, $sql);
        }

        $sql = "DELETE FROM cart WHERE user_id = '$user_id' OR cart.fake_user_id = '$user_id' AND product_id = '$product_id'";
        mysqli_query($conn, $sql);
        $sql = "UPDATE product SET quantity = quantity - $quantity";
        if ($product['product_quantity'] - $quantity == 0) $sql .= ", is_displayed = 0";
        $sql .= " WHERE id = '$product_id'";
        mysqli_query($conn, $sql);
    }

    echo "<script> window.location = 'index.php'; </script>";
}

echo "<style>";
include("./css/customer/cart.css");
echo "</style>";
?>

<div id="cart">
    <div class="added-products">
        <h2>Giỏ hàng của bạn</h2>
        <table>
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tạm tính</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) { ?>
                    <tr class="product-item">
                        <td>
                            <div class="product-meta">
                                <a href="index.php?page=Chitietsanpham&id=<?= $product['product_id'] ?>">
                                    <img src="uploaded-img/product/<?= $product['represent_img'] ?>">
                                </a>
                                <a href="index.php?page=Chitietsanpham&id=<?= $product['product_id'] ?>">
                                    <p><?= $product['product_name'] ?></p>
                                </a>
                                <a href="processProductCart.php?productId=<?= $product['product_id'] ?>&type=delete"><button>Xóa</button></a>
                            </div>
                        </td>
                        <td class="price"><?= $product['price'] ?></td>
                        <td>
                            <div class="quantity">
                                <a href="processProductCart.php?productId=<?= $product['product_id'] ?>&type=minus"><button>-</button></a>
                                <input type="number" value="<?= $product['quantity'] ?>" disabled>
                                <a href="processProductCart.php?productId=<?= $product['product_id'] ?>&type=plus"><button>+</button></a>
                            </div>
                        </td>
                        <td class="price" data-price="<?= $product['price'] ?>"><?= $product['price'] * $product['quantity'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="payment-form">
        <form action="" method="post">
            <div class="customer-info">
                <div>
                    <h2>Thông tin mua hàng</h2>
                    <!-- <a href="">Đăng nhập</a> -->
                </div>
                <input type="text" name="name" value="<?= !empty($user['name']) ? $user['name'] : '' ?>" placeholder="Họ và tên">
                <input type="text" name="phone" value="<?= !empty($user['phone']) ? $user['phone'] : '' ?>" placeholder="Số điện thoại">
                <input type="text" name="email" value="<?= !empty($user['email']) ? $user['email'] : '' ?>" placeholder="Email">
                <input type="text" name="address" value="<?= !empty($user['address']) ? $user['address'] : '' ?>" placeholder="Địa chỉ">
                <textarea name="note" placeholder="Ghi chú(tùy chọn)"></textarea>
            </div>
            <div class="bill-summary">
                <h2>Cộng giỏ hàng</h2>
                <div class="main-bill">
                    <div id="provisional-price">
                        <p>Tạm tính</p><span></span>
                    </div>
                    <div id="discount">
                        <p>Ưu đãi</p><span></span>
                    </div>
                    <div id="total-price">
                        <p>Tổng</p><span></span>
                        <input type="hidden" name="total" value="">
                    </div>
                </div>
                <div id="coupon">
                    <input type="text" value="" placeholder="Mã ưu đãi">
                    <button type="button" id="add-coupon" onclick="calculateBill(this)">Áp dụng</button>
                </div>
                <button type="submit" id="complete-payment">Thanh toán</button>
            </div>
        </form>
    </div>
</div>

<script>
    var coupons = <?php echo json_encode($coupons); ?>;

    function calculateBill(button) {
        var total = 0;
        var prices = document.querySelectorAll('.price[data-price]');
        var quantities = document.querySelectorAll('.quantity input[type="number"]');
        var discount = 0;

        prices.forEach(function(price, index) {
            total += parseFloat(price.getAttribute('data-price')) * parseInt(quantities[index].value);
        });
        document.querySelector('#provisional-price span').textContent = total.toLocaleString('vi-VN') + '₫';

        var coupon = button && button.previousElementSibling.value;
        coupons.forEach(function(data) {
            if (coupon === data.coupon_code) {
                discount = data.discount;
            }
        });

        var discountedTotal = total - (total * discount / 100);

        document.querySelector('#discount span').textContent = discount + '%';
        document.querySelector('input[name="total"]').value = discountedTotal;

        document.querySelector('#total-price span').textContent = discountedTotal.toLocaleString('vi-VN') + '₫';
        button.previousElementSibling.value = '';
    }

    document.addEventListener("DOMContentLoaded", function() {
        calculateBill(null);

        document.getElementById('add-coupon').addEventListener('click', function() {
            var button = this;
            calculateBill(button);
        });
    });
</script>