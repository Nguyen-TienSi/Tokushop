<?php
$order_id = $_GET['id'];
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "UPDATE `order` SET update_date = NOW(), order_state = 'Đã xác nhận' WHERE id = $order_id";
    mysqli_query($conn, $sql);
    header("Location: index.php?page=Donhang");
    exit;
}
?>

<style>
    .wrapper {
        display: flex;
        justify-content: space-evenly;
        padding: 20px;
    }

    div {
        margin-bottom: 10px;
    }

    div span {
        font-weight: bold;
    }

    table {
        border-collapse: collapse;
        margin: auto;
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

    form button {
        padding: 8px 16px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }

    form button:hover {
        background-color: #45a049;
    }
</style>

<div class="wrapper">
    <div>
        <h2 style="margin-bottom: 20px">Thông tin khách hàng</h2>
        <div><span>Tên khách hàng: </span><?= $order_items[0]['name'] ?></div>
        <div><span>Số điện thoại: </span><?= $order_items[0]['phone'] ?></div>
        <div><span>Email: </span><?= $order_items[0]['email'] ?></div>
        <div><span>Địa chỉ: </span><?= $order_items[0]['address'] ?></div>
        <div><span>Ghi chú: </span><?= $order_items[0]['note'] ?></div>
        <div><span>Ngày tạo đơn: </span><?= $order_items[0]['create_date'] ?></div>
        <div><span>Ngày giao: </span><?= $order_items[0]['update_date'] ?></div>
        <div><span>Tình trạng: </span><?= $order_items[0]['order_state'] ?></div>
        <div><span>Tổng giá trị đơn hàng: </span><?= $order_items[0]['total'] ?></div>

        <form action="" method="post">
            <?php if ($order_items[0]['order_state'] == 'Chờ xác nhận') { ?>
                <button type="submit">Xác nhận</button>
                <a href="cancelOrder.php?id=<?= $order_items[0]['id'] ?>"><button type="button">Hủy đơn</button></a>
            <?php } ?>
            <a href="index.php?page=Donhang"><button type="button">Trở lại</button></a>
        </form>
    </div>
    <div>
        <h2 style="margin-bottom: 20px">Thông tin sản phẩm đã đặt</h2>
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Tạm tính</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_items as $index => $item) { ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $item['product_name'] ?></td>
                        <td><?= $item['price'] ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= $item['price'] * $item['quantity'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>