<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = getProduct($id, $all = true, $order = false);
    $imgs = explode(', ', $product[0]['otherImgs']);
}

$category1 = getCategory('category1');
$category2 = getCategory('category2');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['id'];
    $product_name = $_POST['name'];
    $product_price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category1_id = $_POST['category1'];
    $category2_id = $_POST['category2'];
    $description = $_POST['description'];
    $state = $_POST['state'];

    // File upload logic
    $upload_dir = "../uploaded-img/product/";

    $representImg = $_FILES['represent_img']['name'] ? $_FILES['represent_img']['name'] : $_POST['img'];
    $representImg_tmp_name = $_FILES['represent_img']['tmp_name'];
    uploadImg($representImg, $representImg_tmp_name, $upload_dir);

    $otherImgs = '';
    if (!empty($_FILES['multiple_img']['name'])) {
        $img_names = [];
        foreach ($_FILES['multiple_img']['tmp_name'] as $key => $tmp_name) {
            $img_name = $_FILES['multiple_img']['name'][$key];
            uploadImg($img_name, $tmp_name, $upload_dir);
            $img_names[] = $img_name;
        }
        $otherImgs = implode(', ', $img_names);
    }
    $otherImgs = $otherImgs ? $otherImgs : $_POST['imgs'];

    // $sql = "";
    if (empty($product_id)) {
        $sql = "INSERT INTO product (product_name, price, quantity, category1_id, category2_id, description, represent_img, otherImgs, import_date, is_displayed) 
        VALUES ('$product_name', '$product_price', '$quantity', '$category1_id', '$category2_id', '$description', '$representImg', '$otherImgs', NOW(), '$state')";
    } else {
        if (!$state) {
            $sql = "DELETE FROM cart WHERE product_id = $product_id";
            mysqli_query($conn, $sql);
        }

        $sql = "UPDATE product 
        SET product_name = '$product_name', 
            price = '$product_price', 
            quantity = '$quantity',
            category1_id = '$category1_id', 
            category2_id = '$category2_id', 
            description = '$description',
            represent_img = '$representImg',
            otherImgs = '$otherImgs',
            is_displayed = '$state'
        WHERE id = $product_id";
    }

    mysqli_query($conn, $sql);
    header("location: index.php?page=Sanpham");
    exit();
}

echo "<style>";
include("../css/admin/productItem.css");
echo "</style>";
?>

<form action="" method="post" enctype="multipart/form-data">
    <div>
        <input type="hidden" name="id" value="<?= isset($id) ? $id : "" ?>">
    </div>
    <div>
        <label for="category1">Chọn danh mục 1</label>
        <select name="category1" id="category1">
            <?php
            foreach ($category1 as $category) {
                $selected = (!empty($product) && $product[0]['category1_id'] == $category['id']) ? 'selected' : '';
                echo "<option value='{$category['id']}' $selected>{$category['category_name']}</option>";
            }
            ?>
        </select>
        <label for="category2">Chọn danh mục 2</label>
        <select name="category2" id="category2">
            <?php
            foreach ($category2 as $category) {
                $selected = (!empty($product) && $product[0]['category2_id'] == $category['id']) ? 'selected' : '';
                echo "<option value='{$category['id']}' $selected>{$category['category_name']}</option>";
            }
            ?>
        </select>
    </div>
    <div>
        <label for="">Tên sản phẩm</label>
        <input type="text" name="name" value="<?= !empty($product) ? $product[0]['product_name'] : "" ?>" placeholder="Tên sản phẩm">
    </div>
    <div>
        <label for="">Giá sản phẩm</label>
        <input type="text" name="price" value="<?= !empty($product) ? $product[0]['price'] : "" ?>" placeholder="Giá sản phẩm">
    </div>
    <div>
        <label for="">Số lượng sản phẩm</label>
        <input type="number" name="quantity" value="<?= !empty($product) ? $product[0]['quantity'] : "" ?>" placeholder="Số lượng sản phẩm">
    </div>
    <div>
        <label for="">Ảnh đại diện</label>
        <input type="file" name="represent_img">
        <input type="hidden" name="img" value="<?= !empty($product) ? $product[0]['represent_img'] : "" ?>">
        <div>
            <img src="../uploaded-img/product/<?= $product[0]['represent_img'] ?>"
                style="display: <?= (!empty($product[0]['represent_img'])) ? "" : "none" ?>; width: 200px; height: 200px"
                id="represent_img">
        </div>
    </div>
    <div>
        <label for="">Ảnh khác</label>
        <input type="file" name="multiple_img[]" multiple>
        <input type="hidden" name="imgs" value="<?= !empty($product) ? $product[0]['otherImgs'] : "" ?>">
        <div id="multiple-imgs-preview">
            <?php
            if (!empty($imgs)) {
                foreach ($imgs as $img) { ?>
                    <img src="../uploaded-img/product/<?= $img ?>" style="display: <?= $img ? "" : "none" ?>; width: 100px; height: 100px" />
            <?php }
            } ?>
        </div>
    </div>
    <div>
        <label>Mô tả sản phẩm</label><br>
        <textarea name="description"><?= !empty($product) ? $product[0]['description'] : "" ?></textarea>
    </div>
    <div>
        <input type="radio" id="display" name="state" value="1" <?= (!empty($product) && $product[0]['is_displayed'] == 1) ? 'checked' : "" ?> />
        <label for="display">Hiển thị</label>
        <input type="radio" id="hide" name="state" value="0" <?= (!empty($product) && $product[0]['is_displayed'] == 0) ? 'checked' : "" ?> />
        <label for="hide">Ẩn</label>
    </div>
    <button type="submit">Lưu</button>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector('input[name="represent_img"]').addEventListener('change', function() {
            const input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('represent_img').src = e.target.result;
                    document.getElementById('represent_img').style.display = "";
                }

                reader.readAsDataURL(input.files[0]);
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector('input[name="multiple_img[]"]').addEventListener('change', function() {
            const files = this.files;
            const preview = document.querySelector('#multiple-imgs-preview');
            preview.innerHTML = '';
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.height = '100px';
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>