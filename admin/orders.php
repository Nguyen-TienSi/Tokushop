<?php
$sql = "SELECT * FROM `order` ORDER BY (order_state = 'Chờ xác nhận') DESC, create_date ASC";
$result = mysqli_query($conn, $sql);
$orders = [];
while ($row = mysqli_fetch_assoc($result)) {
    $orders[] = $row;
}

$page_number = isset($_GET['index']) ? $_GET['index'] : 1;
$result_per_page = 6;
$start_from = ($page_number - 1) * $result_per_page;
$number_of_result = count($orders);
$total_pages = ceil($number_of_result / $result_per_page);
$orders = array_slice($orders, $start_from, $result_per_page);
?>

<style>
    table {
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

    td button {
        padding: 5px 10px;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
    }

    #pagination {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }

    #pagination button {
        width: 50px;
        height: 50px;
        appearance: none;
        border: none;
        outline: none;
        cursor: pointer;
        background-color: white;
        margin: 5px;
        transition: 0.4s;
        color: black;
        font-size: 18px;
        text-shadow: 0px 0px 4px rgba(0, 0, 0, 0.2);
        box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.2);
    }

    #pagination button:hover {
        background-color: blue;
        color: white;
    }

    #pagination button.active {
        background-color: blue;
        color: white;
        box-shadow: inset 0px 0px 4px rgba(0, 0, 0, 0.2);
    }

    #pagination .move-btn {
        border-radius: 100px;
        width: 25px;
        height: 25px;
        font-size: 18px;
    }
</style>

<h2 style="margin: 20px; text-align: center">Thông tin đơn hàng</h2>

<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Ngày tạo đơn</th>
            <th>Ngày giao</th>
            <th>Tổng tiền</th>
            <th>Tình trạng</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $index => $order) { ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $order['name'] ?></td>
                <td><?= $order['phone'] ?></td>
                <td><?= $order['email'] ?></td>
                <td><?= $order['address'] ?></td>
                <td><?= $order['create_date'] ?></td>
                <td><?= $order['update_date'] ?></td>
                <td><?= $order['total'] ?></td>
                <td><?= $order['order_state'] ?></td>
                <td>
                    <a href="index.php?page=Chitietdonhang&id=<?= $order['id'] ?>"><button>Chi tiết</button></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div id="pagination">
    <?php
    if ($page_number > 1) {
        echo "<a href='index.php?page=Donhang&index=" . ($page_number - 1) . "'><button class='move-btn'>&#10094;</button></a>";
    }

    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='index.php?page=Donhang&index=" . $i . "'><button class='" . ($i == $page_number ? 'active' : '') . "'>$i</button></a>";
    }

    if ($page_number < $total_pages) {
        echo "<a href='index.php?page=Donhang&index=" . ($page_number + 1) . "'><button class='move-btn'>&#10095;</button></a>";
    }
    ?>
</div>