<?php
include("includes/header.php");
?>
<div class="py-3 bg-primary">
    <div class="container">
        <p class="text-white mb-0"><a href="index.php" class="text-white"><?=$sitelang["home"]?></a> / <?=$sitelang["cart"]?></p>
    </div>
</div>
<div class="cart-section">
    <div class="cart_table">
        <div class="container">
            <?php
            $cart = getCartItems();
            if (mysqli_num_rows($cart) > 0) {
            ?>
                <h4 class="title"><i class="fas fa-angle-double-right" style="font-size: large;"></i> <?=$sitelang["shopping cart"]?></h4>
                <div class="py-3"><strong class="text-success float-right"><?=$sitelang["items"]?> (<?= mysqli_num_rows($cart); ?>)</strong></div>
                <div class="table-responsive">
                <table class="table shadow">
                    <thead>
                        <tr>
                            <th scope="col"><?=$sitelang["photo"]?></th>
                            <th scope="col"><?=$sitelang["name"]?></th>
                            <th scope="col"><?=$sitelang["price"]?></th>
                            <th scope="col"><?=$sitelang["qty"]?></th>
                            <th scope="col"><?=$sitelang["action"]?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($cart as $cartItem) {
                        ?>
                            <tr class="product_data">
                                <td><img src="uploads/<?= $cartItem["photo"] ?>" style="width:80px" onerror="src='assets/images/no-image.jpg'" alt=""></td>
                                <td><?= $cartItem[$sitelang["prefix"]."name"] ?></td>
                                <td><?= number_format($cartItem["selling_price"]) ?> <?=$sitelang["currency"]?></td>
                                <td>
                                    <div class="input-group mt-3 mb-3 mx-auto" style="width:150px;">
                                        <input type="hidden" name="hidden_id" class="hidden_id" value="<?= $cartItem["product_id"] ?>">
                                        <div class="input-group-prepend">
                                            <button class="input-group-text decrement-btn updateQty"><i class="fas fa-minus fa-sm"></i></button>
                                        </div>
                                        <input type="text" value="<?= $cartItem["product_qty"]? $cartItem["product_qty"]:"1" ?>" disabled class="bg-white form-control text-center input-qty">
                                        <input type="hidden" class="testQty" value="<?=$cartItem["qty"]?>">
                                        <div class="input-group-append">
                                            <button class="input-group-text increment-btn updateQty"><i class="fas fa-plus fa-sm"></i></button>
                                        </div>
                                    </div>
                                </td>
                                <td><button class="btn btn-sm btn-danger delete_item" value="<?= $cartItem["cid"] ?>"><i class="fas fa-trash fa-sm me-2"></i> <?=$sitelang["remove"]?></button></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                </div>
                <div class="text-right py-4">
                    <a href="checkout.php" class="btn btn-dark"><?=$sitelang["proceed to checkout"]?> <i class="fas fa-arrow-right" style="font-size: x-small;"></i></a>
                </div>
            <?php
            } else {
            ?>
                <div class="bg-light py-4 text-center my-4">
                    <img src="assets/images/cartempty.png" class="d-block mx-auto my-2" style="width: 200px;" alt="">
                    <h3 class="my-4 d-block"><?=$sitelang["no items in cart"]?></h3>
                    <a href="products.php" class="custom-btn"><?=$sitelang["shop now"]?></a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>