<?php
$sql = "SELECT * FROM contact";
$result = mysqli_query($conn, $sql);
$contacts = [];
while ($row = mysqli_fetch_assoc($result)) {
    $contacts[] = $row;
}

$page_number = isset($_GET['index']) ? $_GET['index'] : 1;
$result_per_page = 6;
$start_from = ($page_number - 1) * $result_per_page;
$number_of_result = count($contacts);
$total_pages = ceil($number_of_result / $result_per_page);
$contacts = array_slice($contacts, $start_from, $result_per_page);
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

<h2 style="margin: 20px; text-align: center">Yêu cầu hỗ trợ</h2>

<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên khách hàng</th>
            <th>Email</th>
            <th>Yêu cầu</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contacts as $index => $contact) { ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $contact['name'] ?></td>
                <td><?= $contact['email'] ?></td>
                <td><?= $contact['request'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div id="pagination">
    <?php
    if ($page_number > 1) {
        echo "<a href='index.php?page=Yeucauhotro&index=" . ($page_number - 1) . "'><button class='move-btn'>&#10094;</button></a>";
    }

    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='index.php?page=Yeucauhotro&index=" . $i . "'><button class='" . ($i == $page_number ? 'active' : '') . "'>$i</button></a>";
    }

    if ($page_number < $total_pages) {
        echo "<a href='index.php?page=Yeucauhotro&index=" . ($page_number + 1) . "'><button class='move-btn'>&#10095;</button></a>";
    }
    ?>
</div>