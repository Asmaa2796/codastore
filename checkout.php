<?php
include("includes/header.php");
include("authentication.php");
?>
<div class="py-3 bg-primary">
    <div class="container">
        <p class="text-white mb-0"><a href="index.php" class="text-white"><?=$sitelang["home"]?></a> / <?=$sitelang["checkout"]?></p>
    </div>
</div>
<div class="container">
    <div class="card add shadow my-5 pr-3 pl-3">
        <form action="functions/placeOrder.php" method="post">
            <div class="row">
                <div class="col-md-7">
                    <h5 class="title"><?=$sitelang["basic information"]?></h5>
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
                            <div class="form-group">
                                <label><?=$sitelang["name"]?></label>
                                <input type="text" name="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?=$sitelang["email"]?></label>
                                <input type="email" name="email" inputmode="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?=$sitelang["phone"]?></label>
                                <input type="text" name="phone" inputmode="numeric">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><?=$sitelang["pin code"]?></label>
                                <input type="text" name="pincode" inputmode="numeric">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?=$sitelang["address"]?></label>
                                <textarea name="address"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <h5 class="title"><?=$sitelang["order details"]?></h5>
                    <table class="table shadow-sm">
                        <tbody>
                            <?php
                            $cart = getCartItems();
                            $total = 0;
                            foreach ($cart as $cartItem) {
                            ?>
                                <tr class="product_data">
                                    <td><img src="uploads/<?= $cartItem["photo"] ?>" style="width:50px" onerror="src='assets/images/no-image.jpg'" alt=""></td>
                                    <td><?= $cartItem[$sitelang["prefix"]."name"] ?></td>
                                    <td><?= number_format($cartItem["selling_price"]) ?> <?=$sitelang["currency"]?></td>
                                    <td><?= $cartItem["product_qty"] ? $cartItem["product_qty"]:"1" ?></td>
                                </tr>
                            <?php
                                $total += $cartItem["selling_price"] * ($cartItem["product_qty"]?$cartItem["product_qty"]:"1");
                            }
                            ?>
                        </tbody>
                    </table>
                    <div><b><?=$sitelang["total price"]?>: </b><b class="float-right text-success"><?= $total ?> <?=$sitelang["currency"]?></b></div>
                    <div class="py-4">
                        <input type="hidden" name="payment_method" value="COD">
                        <button type="submit" name="place_order" class="text-white btn btn-dark btn-block"><?=$sitelang["place order"]?> | <?=$sitelang["cod"]?> </button></div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include("includes/footer.php") ?>