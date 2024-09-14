<?php
$order_id = $_GET['orderId'];
$sql = "SELECT `order`.*, order_item.quantity, product.product_name, product.price 
        FROM `order`
        LEFT JOIN order_item ON `order`.id = order_item.order_id
        LEFT JOIN product ON order_item.product_id = product.id
        WHERE `order`.id = $order_id";
$result = mysqli_query($conn, $sql);
$order_items = [];
while ($row = mysqli_fetch_assoc($result)) {
    $order_items[] = $row;
}

echo "<style>";
include("./css/customer/orderDetail.css");
echo "</style>";
?>

<div class="order-detail">
    <div>
        <h2>Đơn hàng</h2>
        <table>
            <tbody>
                <tr>
                    <th class="row-header">Mã đơn</th>
                    <td><?= $order_items[0]['id'] ?></td>
                </tr>
                <tr>
                    <th class="row-header">Họ và tên</th>
                    <td><?= $order_items[0]['name'] ?></td>
                </tr>
                <tr>
                    <th class="row-header">Số điện thoại</th>
                    <td><?= $order_items[0]['phone'] ?></td>
                </tr>
                <tr>
                    <th class="row-header">Ngày đặt</th>
                    <td><?= $order_items[0]['create_date'] ?></td>
                </tr>
                <tr>
                    <th class="row-header">Ngày giao</th>
                    <td><?= $order_items[0]['update_date'] ?></td>
                </tr>
                <tr>
                    <th class="row-header">Tổng tiền</th>
                    <td><?= $order_items[0]['total'] ?></td>
                </tr>
                <tr>
                    <th class="row-header">Trạng thái</th>
                    <td><?= $order_items[0]['order_state'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div>
        <table>
            <h2>Sản phẩm đã đặt</h2>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Tạm tính</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_items as $index => $item) { ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $item['product_name'] ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= $item['price'] ?></td>
                        <td><?= $item['price'] * $item['quantity'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>