<?php
$coupons = [];
$sql = "SELECT * FROM coupon";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $coupons[] = $row;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $coupon_code = $_POST['code'];
    $discount = $_POST['discount'];
    $sql = "INSERT INTO coupon (coupon_code, discount, is_valid) VALUES ('$coupon_code', '$discount', 1)";
    mysqli_query($conn, $sql);

    header("Location: index.php?page=Makhuyenmai");
    exit;
}
?>

<style>
    form {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        /* border-radius: 5px; */
        /* box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); */
    }

    input[type="text"],
    input[type="radio"],
    form>button,
    td button {
        margin: 5px;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    form>button,
    td button {
        background-color: #007bff;
        color: white;
        cursor: pointer;
    }

    table {
        width: 70%;
        border-collapse: collapse;
        background: #fff;
        /* box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); */
        margin: 0 auto 50px auto;
    }

    th,
    td {
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f4f4f4;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f1f1;
    }
</style>

<form action="" method="post">
    <label for="">Mã khuyến mãi</label>
    <input type="text" name="code" placeholder="Mã khuyến mãi">
    <label for="">Giảm giá</label>
    <input type="text" name="discount" placeholder="Giảm giá">
    <button type="submit">Lưu</button>
</form>

<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã khuyến mãi</th>
            <th>Giảm giá</th>
            <th>Tình trạng</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($coupons as $index => $coupon) { ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $coupon['coupon_code'] ?></td>
                <td><?= $coupon['discount'] ?></td>
                <td><?= $coupon['is_valid'] ? "Có hiệu lực" : "Vô hiệu" ?></td>
                <td>
                    <a href="processCoupon.php?id=<?= $coupon['id'] ?>"><button>Ẩn/Hiện</button></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>