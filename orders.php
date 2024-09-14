<?php
$user_id = $_SESSION['id'];
$sql = "SELECT * FROM `order` WHERE user_id='$user_id'";
$result = mysqli_query($conn, $sql);
$orders = [];
while ($row = mysqli_fetch_assoc($result)) {
    $orders[] = $row;
}

echo "<style>";
include("./css/customer/orders.css");
echo "</style>";
?>

<h2 style="text-align: center">Thông tin mua hàng</h2>
<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã đơn</th>
            <th>Tổng tiền</th>
            <th>Ngày tạo</th>
            <th>Ngày giao</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $index => $order) { ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $order['id'] ?></td>
                <td><?= $order['total'] ?></td>
                <td><?= $order['create_date'] ?></td>
                <td><?= $order['update_date'] ?></td>
                <td><?= $order['order_state'] ?></td>
                <td>
                    <a href='index.php?page=Chitietdonhang&orderId=<?= $order['id'] ?>'><button id='ordDetlBtn'>Chi tiết</button></a>
                    <?php if ($order['order_state'] == 'Chờ xác nhận') { ?>
                        <a href="cancelOrder.php?id=<?= $order['id'] ?>"><button id='ordCancelBtn'>Hủy đơn</button></a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>