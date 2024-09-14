<?php
$sql = "SELECT img FROM slideshow WHERE is_displayed=1";
$result = mysqli_query($conn, $sql);
$slides = [];
while ($row = mysqli_fetch_assoc($result)) {
    $slides[] = $row;
}

echo "<style>";
include("./css/customer/slideImage.css");
echo "</style>";
?>

<section class="slider">
    <div class="slides">
        <?php foreach ($slides as $slide) {
            echo "<img src='uploaded-img/slideshow/{$slide['img']}'/>";
        } ?>
    </div>
    <button class="previous" onclick="prevSlide()">&#10094;</button>
    <button class="next" onclick="nextSlide()">&#10095;</button>
</section>

<script src="./js/customer/slideImage.js"></script>