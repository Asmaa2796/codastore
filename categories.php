<?php
include("includes/header.php");
?>
<div class="py-3 bg-primary">
    <div class="container">
        <p class="text-white mb-0"><a href="index.php" class="text-white"><?=$sitelang["home"]?></a> / <a href="categories.php" class="text-white"><?=$sitelang["categories"]?></a></p>
    </div>
</div>
<div class="pd">
    <div class="container">
        <div class="row">
        <?php
            $categories = getAllActive("categories");
            if (mysqli_num_rows($categories) > 0) {
                foreach ($categories as $cat) {
            ?>
                    <div class="col-md-3">
                        <div class="card mt-2 mb-2 shadow text-center">
                            <img class="card-img-top" style="height: 170px;" src="uploads/<?=$cat["photo"]?>" onerror="src='assets/images/no-image.jpg'" alt="Card image cap">
                            <div class="card-body">
                                <h5 style="color:var(--color)" class="card-title mb-0"><?=$cat[$sitelang["prefix"]."name"]?></h5>
                                <!-- <p class="card-text"><?=$cat["description"]?></p> -->
                            </div>
                         </div>
                    </div>
            <?php
                }
            } else {
                echo $sitelang["no categories"];
            }
            ?>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>