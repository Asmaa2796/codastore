<?php
include("includes/header.php");
include("authentication.php");
if (isset($_GET["tracking_no"])) {
    $tracking_no = $_GET["tracking_no"];
    $chk_result = chkTrNoValid($tracking_no);
    if (mysqli_num_rows($chk_result) < 0) {
        echo "somthing went wrong";
        die();
    }
} else {
    echo "somthing went wrong";
    die();
}
$data = mysqli_fetch_array($chk_result);
?>
<div class="py-3 bg-primary">
    <div class="container">
        <p class="text-white mb-0"><a href="index.php" class="text-white"><?=$sitelang["home"]?></a> / <a href="myOrders.php" class="text-white"><?=$sitelang["my orders"]?></a> / <?=$sitelang["order details"]?></p>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><?=$sitelang["order details"]?></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="mb-2" style="font-weight:bold;"><?=$sitelang["name"]?>:</label>
                                <p class="border px-2 py-2"><?= $data["name"] ?></p>
                                <label class="mb-2" style="font-weight:bold;"><?=$sitelang["email"]?>:</label>
                                <p class="border px-2 py-2"><?= $data["email"] ?></p>
                                <label class="mb-2" style="font-weight:bold;"><?=$sitelang["phone"]?>:</label>
                                <p class="border px-2 py-2"><?= $data["phone"] ?></p>
                                <label class="mb-2" style="font-weight:bold;"><?=$sitelang["pin code"]?>:</label>
                                <p class="border px-2 py-2"><?= $data["pincode"] ?></p>
                                <label class="mb-2" style="font-weight:bold;"><?=$sitelang["tracking no"]?>:</label>
                                <p class="border px-2 py-2"><?= $data["tracking_no"] ?></p>
                                <label class="mb-2" style="font-weight:bold;"><?=$sitelang["address"]?>:</label>
                                <p class="border px-2 py-2"><?= $data["address"] ?></p>
                            </div>
                            <div class="col-md-6">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><?=$sitelang["product"]?></th>
                                            <th><?=$sitelang["price"]?></th>
                                            <th><?=$sitelang["qty"]?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $userId = $_SESSION["auth_user"]["ID"];
                                        $order_qry = "SELECT o.ID as oid,o.tracking_no,o.user_id,oi.*,oi.qty as orderQty,p.* FROM orders o,order_items oi,
                                        products p WHERE o.user_id='$userId' AND oi.order_id=o.ID AND p.ID=oi.product_id AND o.tracking_no='$tracking_no'";
                                        $order_qry_run = mysqli_query($conn, $order_qry);
                                        // $items = mysqli_fetch_array($order_qry_run);

                                        if (mysqli_num_rows($order_qry_run) > 0) {
                                            foreach ($order_qry_run as $item) {
                                        ?>
                                                <tr>
                                                    <td>
                                                        <p><?= $item[$sitelang["prefix"]."name"] ?></p>
                                                        <img class="card-img-top" style="width: 50px;" src="uploads/<?= $item["photo"] ?>" onerror="src='assets/images/no-image.jpg'" alt="Card image cap">
                                                    </td>
                                                    <td><?= number_format($item["price"]) ?> <?=$sitelang["currency"]?></td>
                                                    <td><?= $item["orderQty"]?$item["orderQty"]:"1" ?></td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo $sitelang["no order details"];
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <hr>
                                <div class="mb-2"><b><?=$sitelang["total price"]?>: </b><b class="float-right text-success"><?= number_format($data["total_price"]) ?> <?=$sitelang["currency"]?></b></div>
                                <div class="mb-3"><b><?=$sitelang["payment method"]?>: </b><b class="float-right text-success"><?= $data["payment_method"] ?></b></div>
                                <div class="mb-2 border pl-2 pr-2 py-3 bg-light">
                                    <b><?=$sitelang["status"]?>: </b>
                                    <b class="float-right text-success">
                                    <?php
                                        if($data["status"] == 0) {
                                            echo $sitelang["under process"];
                                        }  
                                        else if($data["status"] == 1) {
                                            echo $sitelang["completed"];
                                        }  
                                        else if($data["status"] == 2) {
                                            echo $sitelang["canceled"];
                                        }  
                                      ?>
                                    </b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>