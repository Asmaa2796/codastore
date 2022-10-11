<?php
include("includes/header.php");
?>
<div class="py-3 bg-primary">
    <div class="container">
        <p class="text-white mb-0"><a href="index.php" class="text-white"><?=$sitelang["home"]?> </a> / <a href="products.php" class="text-white"><?=$sitelang["products"]?> </a></p>
    </div>
</div>
<div class="pd">
    <div class="container">
        <form action="" method="GET" class="filter-by">
            <div class="card shadow pt-4 pb-2 px-3">
                <h5 class="mb-0"><b><?=$sitelang["filter by"]?> </b></h5>
                <hr>
                <ul class="list-unstyled">
                    <li><label style="font-weight: bold;cursor:text"><?=$sitelang["category"]?>:</label></li>
                    <?php
                    $categories = getAllActive("categories");
                    if (mysqli_num_rows($categories) > 0) {
                        foreach ($categories as $category) {
                            $checked = [];
                            if (isset($_GET["category"])) {
                                $checked = $_GET["category"];
                            }
                    ?>      
                        <li>
                            <label class="d-flex">
                                <input type="checkbox" <?= (in_array($category["ID"], $checked)) ? "checked" : "" ?> name="category[]" value="<?= $category["ID"] ?>"> &nbsp; <?= $category[$sitelang["prefix"]."name"] ?>
                            </label>
                        </li>
                    <?php
                        }
                    } else {
                        echo $sitelang["no categories"];
                    }
                    ?>
                    <li><button class="search_btn" type="submit"><i class="fas fa-search"></i></button></li>
                </ul>
            </div>
        </form>
        <div class="filter-products my-3">
            <div class="row">
                <?php
                if (isset($_GET["category"])) {
                    $categoryChecked = [];
                    $categoryChecked = $_GET["category"];
                    foreach ($categoryChecked as $cat) {
                        $query = "SELECT * FROM products WHERE category_name IN ($cat)";
                        $query_run = mysqli_query($conn, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                            ?>
                                <div class="col-lg-3 col-md-4 col-12">
                                    <a class="product d-block" style="margin: 10px 0;" href="productDetails.php?id=<?= $row["ID"] ?>">
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
                                               <div class="text-center">
                                                    <span class="price"><?= number_format($row["selling_price"]) ?> <?=$sitelang["currency"]?> </span>
                                                    <span class="del font-italic"><?= number_format($row["original_price"]) ?> <?=$sitelang["currency"]?> </span>

                                                </div>
                                                <button class="add_to_cart" value="<?= $row["ID"] ?>"><img class="c-img" src="assets/images/cart.png" alt=""></button>
                                            <?php
                                            } else {
                                            ?>
                                                <p class="text-secondary text-center my-1"><?=$sitelang["not available"]?> </p>
                                            <?php
                                            }
                                            ?>

                                            <button class="btn show-more"><?=$sitelang["show more"]?> </button>
                                        </div>
                                    </a>
                                </div>
                            <?php
                            }
                        }
                    }
                } 
                elseif (isset($_GET["search"])) {
                    $filter_products = $_GET["search"];
                    $query = "SELECT * FROM products WHERE CONCAT(name,ar_name,small_description,ar_small_description) LIKE '%$filter_products%'";
                        $query_run = mysqli_query($conn, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                            ?>
                                <div class="col-lg-3 col-md-4 col-12">
                                    <a class="product d-block" style="margin: 10px 0;" href="productDetails.php?id=<?= $row["ID"] ?>">
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
                                               <div class="text-center">
                                                    <span class="price"><?= number_format($row["selling_price"]) ?> <?=$sitelang["currency"]?> </span>
                                                    <span class="del font-italic"><?= number_format($row["original_price"]) ?> <?=$sitelang["currency"]?> </span>

                                                </div>
                                                <button class="add_to_cart" value="<?= $row["ID"] ?>"><img class="c-img" src="assets/images/cart.png" alt=""></button>
                                            <?php
                                            } else {
                                            ?>
                                                <p class="text-secondary text-center my-1"><?=$sitelang["not available"]?> </p>
                                            <?php
                                            }
                                            ?>

                                            <button class="btn show-more"><?=$sitelang["show more"]?> </button>
                                        </div>
                                    </a>
                                </div>
                            <?php
                            }
                        }
                }
                else {
                    $products = getAllActive("products");
                    if (mysqli_num_rows($products) > 0) {
                        foreach ($products as $row) {
                        ?>
                            <div class="col-lg-3 col-md-4 col-12">
                                <a class="product d-block" style="margin: 10px 0;" href="productDetails.php?id=<?= $row["ID"] ?>">
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
                                        <h5><?=$row[$sitelang["prefix"]."name"]?></h5>
                                        <p><?= $row[$sitelang["prefix"]."small_description"] ?></p>
                                        <hr>
                                        <?php
                                        if ($row["qty"] > 0) {
                                        ?>
                                            <div class="text-center">
                                                <span class="price"><?=number_format($row["selling_price"]); ?> <?=$sitelang["currency"]?> </span>
                                                <span class="del font-italic"><?= number_format($row["original_price"]) ?> <?=$sitelang["currency"]?> </span>
                                            </div>
                                            <button class="add_to_cart" value="<?= $row["ID"] ?>"><img class="c-img" src="assets/images/cart.png" alt=""></button>
                                        <?php
                                        } else {
                                        ?>
                                            <p class="text-secondary text-center my-1"><?=$sitelang["not available"]?> </p>
                                        <?php
                                        }
                                        ?>

                                        <button class="btn show-more"><?=$sitelang["show more"]?> </button>
                                    </div>
                                </a>
                            </div>
                        <?php
                        }
                    } 
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>