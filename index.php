<?php
include("includes/header.php");
?>
<div class="shop-now py-2"><?=$sitelang["sale"]?></div>
<header class="pd">
  <div class="container">
    <!-- <?php
    if (isset($_SESSION["message"])) {
    ?>
      <span class="alert bg-white text-valid" role="alert">
        <?= $_SESSION['message']; ?>
      </span>
    <?php
      unset($_SESSION["message"]);
    }
    ?> -->
    <div class="row">
      <div class="col-md-5">
        <div class="text">
          <div class="title wow fadeInUp" data-wow-duration="1s" data-wow-offset="100" data-wow-delay=".3s">
            <h2><?=$sitelang["Get up to 30% off"]?> </h2>
            <h2 class="sp"><?=$sitelang["New Arrivals"]?></h2>
          </div>
          <p class="wow fadeInUp" data-wow-duration="1s" data-wow-offset="100" data-wow-delay=".5s">
              <?=$sitelang["lorem"]?>
          </p>
          <form action="products.php" class="search-pr wow fadeInUp" data-wow-duration="1s" data-wow-delay=".8s">
            <input type="text" required name="search" value="<?php if(isset($_GET["search"])) {echo $_GET["search"];} ?>" placeholder="<?=$sitelang["search products ex mobiles"]?>">  
            <button type="submit"><?=$sitelang["search"]?> <i class="fas fa-chevron-right" style="font-size: small;"></i></button>
          </form>
        </div>
      </div>
      <div class="col-md-7 text-center">
        <img class="wow fadeIn" data-wow-duration="1s" data-wow-offset="100" data-wow-delay=".3s" src="assets/images/header.png" style="width: 80%;" alt="">
      </div>
    </div>
  </div>
</header>
<img src="assets/images/wave.svg" alt="">

<!-- services -->
<div class="services pd">
  <div class="container">
    <h3 class="title"><i class="fas fa-angle-double-right" style="font-size: x-large;"></i> <?=$sitelang["services"]?></h3>
    <div class="row">
      <div class="col-md-4">
        <div class="service">
        <img src="assets/images/world-wide.png" alt="">
          <h5><?=$sitelang["worldwide delivery"]?></h5>
          <p><?=$sitelang["lorem"]?></p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="service">
          <img src="assets/images/secure-payment.png" alt="">
          <h5><?=$sitelang["secure payments"]?></h5>
          <p><?=$sitelang["lorem"]?></p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="service">
          <img src="assets/images/return-box.png" alt="">
          <h5><?=$sitelang["simple returns"]?></h5>
          <p><?=$sitelang["lorem"]?></p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- products -->
<div class="products pd">
  <div class="container">
    <h3 class="title"><i class="fas fa-angle-double-right" style="font-size: x-large;"></i> <?=$sitelang["products"]?></h3>
    <div class="owl-carousel owl-theme" id="products">

      <?php
      $products = getAllActive("products");
      if (mysqli_num_rows($products) > 0) {
        foreach ($products as $row) {
      ?>
          <div class="item">
            <a class="product d-block" href="productDetails.php?id=<?= $row["ID"] ?>">
              <div class="text-center">
                <br>
                <img src="uploads/<?= $row["photo"] ?>" onerror="src='assets/images/no-image.jpg'" alt="<?= $row["name"] ?>">
              </div>
              <?php
              if ($row["trending"]) {
              ?>
                <b class="text-center d-block trending">
                <i class="fas fa-fire"></i> <?=$sitelang["trending"]?> 
                </b>
              <?php
              }
              ?>
              <div class="product-footer">
                <h5><?= $row[$sitelang["prefix"]."name"] ?></h5>
                <p><?= $row[$sitelang["prefix"]."small_description"] ?></p>
                <hr>
                <?php
                if ($row["qty"] > 0) {
                ?>
                  <button class="add_to_cart" value="<?= $row["ID"] ?>"><img class="c-img" src="assets/images/cart.png" alt=""></button>
                  <div class="text-center">
                    <span class="price"><?= number_format($row["selling_price"]) ?> <?=$sitelang["currency"]?></span>&nbsp;
                    <span class="del font-italic"><?= number_format($row["original_price"]) ?> <?=$sitelang["currency"]?></span>
                  </div>
                <?php
                } else {
                ?>
                  <p class="text-secondary text-center my-1"><?=$sitelang["not available"]?></p>
                <?php
                }
                ?>
                <button class="btn show-more"><?=$sitelang["show more"]?></button>
              </div>
            </a>
          </div>
      <?php
        }
      } else {
        echo $sitelang["no products"];
      }
      ?>
    </div>
  </div>
</div>

<!-- testimonials -->
<div class="testimonials pd text-center mb-3">
  <div class="container">
    <h2 class="title text-center"><?=$sitelang["our satisfied customer says"]?></h2>
    <div class="owl-carousel owl-theme" id="testimonials">
      <div class="item">
        <div class="testi text-center">
          <div class="img-testi">
            <img src="assets/images/1.webp" alt="">
            <div class="quotes">
              <img src="assets/images/quote.png" alt="">
            </div>
          </div>
          <p><?=$sitelang["lorem"]?></p>
          <h5><?=$sitelang["lorem ipsum"]?></h5>
          <span><?=$sitelang["web developer"]?></span>
        </div>
      </div>
      <div class="item">
        <div class="testi text-center">
          <div class="img-testi">
            <img src="assets/images/1.webp" alt="">
            <div class="quotes">
              <img src="assets/images/quote.png" alt="">
            </div>
          </div>
          <p><?=$sitelang["lorem"]?></p>
          <h5><?=$sitelang["lorem ipsum"]?></h5>
          <span><?=$sitelang["web developer"]?></span>
        </div>
      </div>
      <div class="item">
        <div class="testi text-center">
          <div class="img-testi">
            <img src="assets/images/1.webp" alt="">
            <div class="quotes">
              <img src="assets/images/quote.png" alt="">
            </div>
          </div>
          <p><?=$sitelang["lorem"]?></p>
          <h5><?=$sitelang["lorem ipsum"]?></h5>
          <span><?=$sitelang["web developer"]?></span>
        </div>
      </div>
    </div>
  </div>
  <img src="assets/images/wave1.svg" class="wave" alt="">
</div>

<!-- partners -->
<div class="partners pd text-center mb-3">
  <div class="container">
    <h3 class="title"><i class="fas fa-angle-double-right" style="font-size: x-large;"></i> <?=$sitelang["partners"]?></h3>
    <div class="row py-4">
      <div class="col-lg-3 col-md-4 col-12">
        <div class="part">
          <img src="assets/images/p.webp" alt="">
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-12">
        <div class="part">
          <img src="assets/images/p2.webp" alt="">
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-12">
        <div class="part">
          <img src="assets/images/p3.webp" alt="">
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-12">
        <div class="part">
          <img src="assets/images/p4.webp" alt="">
        </div>
      </div>
    </div>
  </div>
</div>

<!-- subscribe -->
<div class="subscribe pd text-center">
  <img src="assets/images/email-marketing.png" alt="">
  <div class="container">
    <h3 class="mb-5"><?=$sitelang["subscribe for Our Newsletter"]?></h3>
    <form action="">
      <input type="email" name="" id="" placeholder="<?=$sitelang["email"]?>">
      <button class="custom-btn"><?=$sitelang["send"]?></button>
    </form>
  </div>
</div>

<?php include("includes/footer.php") ?>