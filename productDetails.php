<?php
include("includes/header.php");
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $productDetails_data = getIDActive("products", $id);
    $row = mysqli_fetch_array($productDetails_data);
    $cat_id = $row["category_name"];
    $query = "SELECT name,ar_name FROM categories WHERE ID='$cat_id'";
    $query_run = mysqli_query($conn, $query);
    $qry = mysqli_fetch_array($query_run);
    $name = $qry[$sitelang["prefix"]."name"];
    if ($row > 0) {
        ?>
            <div class="py-3 bg-primary">
                <div class="container">
                    <p class="text-white mb-0"><a href="index.php" class="text-white"><?=$sitelang["home"]?></a> / <a href="products.php" class="text-white"><?=$sitelang["products"]?></a> / <?= $row[$sitelang["prefix"]."name"] ?></p>
                </div>
            </div>
            <div class="productsDetails py-3 product_data mb-2">
                <div class="container">
                    <h4 class="title"><i class="fas fa-angle-double-right" style="font-size: large;"></i> <?=$sitelang["product details"]?></h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card shadow mb-2">
                                <img src="uploads/<?= $row["photo"] ?>" onerror="src='assets/images/no-image.jpg'" alt="">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="details">
                                <h4>
                                    <?= $row[$sitelang["prefix"]."name"] ?>
                                    <?php
                                    if($row["trending"]) {
                                        ?>
                                        <strong class="float-right text-danger">
                                        <i class="fas fa-fire"></i> <?=$sitelang["trending"]?>
                                        </strong>
                                        <?php
                                    }
                                    ?>
                                </h4>
                                <hr>
                                <span class="mb-2 tag" style="display: inline-block;padding:4px;">
                                    <i class="fas fa-tag"></i>
                                    <?=$name;?>
                                </span>
                                <p class="mt-2"><?= $row[$sitelang["prefix"]."small_description"] ?></p>
                                <hr>
                                <?php
                                    if($row["qty"] > 0) {
                                        ?>
                                            <strong class="text-success"><?= number_format($row["selling_price"]) ?> <?=$sitelang["currency"]?></strong>
                                            <del style="font-size: small;" class="text-danger"><?= number_format($row["original_price"]) ?> <?=$sitelang["currency"]?></del>
                                            <div class="input-group mt-3 mb-3" style="width:150px;">
                                                <div class="input-group-prepend">
                                                    <button class="input-group-text decrement-btn"><i class="fas fa-minus fa-sm"></i></button>
                                                </div>
                                                <input type="text" value="1" disabled class="bg-white form-control text-center input-qty">
                                                <input type="hidden" class="testQty" value="<?=$row["qty"]?>">
                                                <div class="input-group-append">
                                                    <button class="input-group-text increment-btn"><i class="fas fa-plus fa-sm"></i></button>
                                                </div>
                                            </div>
                                            <div>
                                                <button class="custom-btn text-white add_to_cart" value="<?=$row["ID"]?>"><i class="fas fa-shopping-basket"></i> <?=$sitelang["add to cart"]?></button>
                                            </div>
                                            <hr>
                                        <?php
                                    } else {
                                        ?>
                                            <p class="text-secondary text-center my-4"><?=$sitelang["not available"]?></p>
                                        <?php
                                    }
                                ?>
                               
                              
                                <b><?=$sitelang["product description"]?>:</b>
                                <p class="mt-2"><?= $row[$sitelang["prefix"]."description"] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    } else {
        echo "Something went wrong";
    }
} else {
    echo "Product not found";
}
?>

<!-- products -->
<div class="products pd">
  <div class="container">
    <h4 class="title"><i class="fas fa-angle-double-right" style="font-size: large;"></i> <?=$sitelang["related products"]?></h3>
    <div class="owl-carousel owl-theme" id="related_products">

      <?php
      $products = getProductByCategory($cat_id,$id);
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
                    <span class="price"><?= number_format($row["selling_price"]) ?> <?=$sitelang["currency"]?></span>
                    <span class="del font-italic"><?= number_format($row["original_price"]) ?> <?=$sitelang["currency"]?></span>
                  </div>
                <?php
                } else {
                ?>
                  <p class="text-secondary text-center my-4"><?=$sitelang["not available"]?></p>
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
        ?>
          <div class="bg-light py-4 text-center my-4">
              <img src="assets/images/cartempty.png" class="d-block mx-auto my-2" style="width: 120px;" alt="">
              <h5 class="my-4 d-block"><?= $sitelang["no related products"] ?></h5>
            </div>
        <?php
      }
      ?>
    </div>
  </div>
</div>
<?php
include("includes/footer.php");
?>