<?php
include("includes/navbar.php");
include("../middleware/adminMiddleware.php");
?>

<div class="products pd">
    <?php
    if (isset($_SESSION["message"])) {
    ?>
        <div class="alert alert-warning text-valid" role="alert">
            <?= $_SESSION['message']; ?>
        </div>
    <?php
        unset($_SESSION["message"]);
    }
    ?>
    <div class="row">
        <div class="col-md-6">
            <h4 class="title"><i class="fas fa-caret-right"></i> Products</h4>
        </div>
        <div class="col-md-6 text-right">
            <br>
            <a href="addProduct.php" class="btn btn-dark text-white"><i class="fas fa-eye"></i> Add product</a>
        </div>
    </div>
    <?php
    $products = getAll("products");
    if (mysqli_num_rows($products) > 0) {
    ?>
        <div id="products_table">
            <div class="row">
                <?php
                foreach ($products as $product) {
                ?>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card view-card shadow py-2 px-4 mt-4 mb-2">
                            <div class="img"><img src="../uploads/<?= $product["photo"]; ?>" onerror="src='assets/images/no-image.jpg'" alt="<?= $cat["name"]; ?>"></div>
                            <b>ID - <?= $product["ID"]; ?></b>
                            <h5 class="my-2 name"><?= $product["name"]; ?></h5>
                            <h5 class="mt-2 mb-3 ar_name name"><?= $product["ar_name"]; ?></h5>
                            <div class="tag my-2 py-2"><i class="fas fa-tag"></i>
                             <?php 
                             $cat_id = $product["category_name"];
                             $query = "SELECT name FROM categories WHERE ID='$cat_id'";
                             $query_run = mysqli_query($conn, $query);
                             $qry = mysqli_fetch_array($query_run);
                             $name = $qry["name"];
                             ?>
                             <?=$name;?>
                            </div>
                            <p class="text-success"><?= number_format($product["selling_price"]); ?> EGP</p>
                            <div class="flex-div">
                                <button class="btn round <?= $product["status"] == 1 ? "btn-primary" : "btn-secondary"; ?>"><i class="fas fa-ban"></i></button>
                                <button class="btn round <?= $product["trending"] == 1 ? "btn-primary" : "btn-secondary"; ?>"><i class="fas fa-ban"></i></button>
                                <button class="btn round btn-success"><a class="text-white" href="editProduct.php?id=<?= $product["ID"] ?>" class="btn btn-sm btn-success"><i class="fas fa-pen"></i></a></button>
                                <button type="button" class="btn btn-danger round delete_product_btn" value="<?= $product["ID"] ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    } else {
        echo "no products";
    }
    ?>

</div>

<?php
include("includes/footer.php");
?>