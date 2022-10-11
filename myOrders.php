<?php
include("includes/header.php");
include("authentication.php");
?>
<div class="py-3 bg-primary">
    <div class="container">
        <p class="text-white mb-0"><a href="index.php" class="text-white"><?=$sitelang["home"]?></a> / <?=$sitelang["my orders"]?></p>
    </div>
</div>
<div class="container">
        <?php
        $orders = getOrders();
        if (mysqli_num_rows($orders) > 0) {
        ?>
            <h3 class="title"><?=$sitelang["my orders"]?></h3>
            <div class="py-3"><strong class="text-success float-right"><?=$sitelang["orders"]?> (<?= mysqli_num_rows($orders); ?>)</strong></div>
            <div class="table-responsive">
            <table class="table shadow bg-light">
                <thead>
                    <tr>
                        <th scope="col"><?=$sitelang["id"]?></th>
                        <th scope="col"><?=$sitelang["tracking no"]?></th>
                        <th scope="col"><?=$sitelang["total price"]?></th>
                        <th scope="col"><?=$sitelang["date"]?></th>
                        <th scope="col"><?=$sitelang["view"]?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($orders as $order) {
                    ?>
                        <tr>
                            <td><?=$order["ID"]?></td>
                            <td><?=$order["tracking_no"]?></td>
                            <td><?=number_format($order["total_price"])?> <?=$sitelang["currency"]?></td>
                            <td><?=$order["addDate"]?></td>
                            <td><a href="orderDetails.php?tracking_no=<?=$order["tracking_no"]?>" class="custom-btn btn-sm"><?=$sitelang["view details"]?></a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            </div>
        <?php
        } else {
        ?>
            <h4 class="bg-light py-4 text-center my-4"><?=$sitelang["no orders"]?></h4>
        <?php
        }
        ?>
    </div>

<?php include("includes/footer.php") ?>