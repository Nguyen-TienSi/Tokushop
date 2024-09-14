<style>
  <?php include("./css/customer/home.css"); ?>
</style>

<?php include("slideImage.php"); ?>
<?php include("service.php"); ?>

<div>
  <section class="products">
    <h2>Sản phẩm mới nhất</h2>
    <div>
      <div class="product-group">
        <?php
        $products = array_slice(getProduct(), 0, 4);
        foreach ($products as $product) { ?>
          <div class="product">
            <a href="index.php?page=Chitietsanpham&id=<?= $product['id'] ?>">
              <img src="uploaded-img/product/<?= $product['represent_img'] ?>" />
              <div>
                <p class="product-name"><?= $product['product_name'] ?></p>
                <p class="product-price"><?= $product['price'] ?></p>
              </div>
            </a>
          </div>
        <?php } ?>
      </div>
      <a href="index.php?page=Sanpham" class="seemore">
        <p>Xem thêm</p>
        <p style="font-size: 20px; margin: 3px">></p>
      </a>
    </div>
  </section>

  <section class="feedbacks">
    <h2>Customer's feedback</h2>
    <div>
      <div class="feedback">
        <img src="assets/feedback.png" alt="" />
      </div>
      <div class="feedback">
        <img src="assets/feedback.png" alt="" />
      </div>
      <div class="feedback">
        <img src="assets/feedback.png" alt="" />
      </div>
      <div class="feedback">
        <img src="assets/feedback.png" alt="" />
      </div>
    </div>
  </section>
</div>