<?php
$sql = "SELECT * FROM user WHERE role = 'customer'";
$result = mysqli_query($conn, $sql);
$accounts = [];
while ($row = mysqli_fetch_assoc($result)) {
    $accounts[] = $row;
}

$page_number = isset($_GET['index']) ? $_GET['index'] : 1;
$result_per_page = 6;
$start_from = ($page_number - 1) * $result_per_page;
$number_of_result = count($accounts);
$total_pages = ceil($number_of_result / $result_per_page);
$accounts = array_slice($accounts, $start_from, $result_per_page);
?>

<style>
    table {
        border-collapse: collapse;
        margin: 20px auto;
    }

    th, td {
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

<h2 style="margin: 20px; text-align: center">Thông tin khách hàng</h2>

<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên đăng nhập</th>
            <th>Tên tài khoản</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Tình trạng</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($accounts as $index => $account) { ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $account['username'] ?></td>
                <td><?= $account['name'] ?></td>
                <td><?= $account['phone'] ?></td>
                <td><?= $account['email'] ?></td>
                <td><?= $account['address'] ?></td>
                <td><?= !($account['is_locked']) ? "Đang hoạt động" : "Đang khóa" ?></td>
                <td>
                    <a href="processAccount.php?id=<?= $account['id'] ?>"><button>Khóa/Mở khóa</button></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div id="pagination">
    <?php
    if ($page_number > 1) {
        echo "<a href='index.php?page=Taikhoan&index=" . ($page_number - 1) . "'><button class='move-btn'>&#10094;</button></a>";
    }

    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='index.php?page=Taikhoan&index=" . $i . "'><button class='" . ($i == $page_number ? 'active' : '') . "'>$i</button></a>";
    }

    if ($page_number < $total_pages) {
        echo "<a href='index.php?page=Taikhoan&index=" . ($page_number + 1) . "'><button class='move-btn'>&#10095;</button></a>";
    }
    ?>
</div>