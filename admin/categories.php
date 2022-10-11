<?php
include("includes/navbar.php");
include("../middleware/adminMiddleware.php");
?>

<div class="categories pd">
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
            <h4 class="title"><i class="fas fa-caret-right"></i> Categories</h4>
        </div>
        <div class="col-md-6 text-right">
            <br>
            <a href="addCategory.php" class="btn btn-dark text-white"><i class="fas fa-eye"></i> Add category</a>
        </div>
    </div>
    <?php
    $categories = getAll("categories");
    if (mysqli_num_rows($categories) > 0) {
    ?>
        <div id="categories_table">
            <div class="row">
                <?php
                foreach ($categories as $cat) {
                ?>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card view-card shadow py-2 px-4 mt-4">
                            <div class="img"><img src="../uploads/<?= $cat["photo"]; ?>" onerror="src='assets/images/no-image.jpg'" alt="<?= $cat["name"]; ?>"></div>
                            <b>ID - <?= $cat["ID"]; ?></b>
                            <h5 class="mt-3 name"><?= $cat["name"]; ?></h5>
                            <h5 class="mt-2 mb-3 ar_name name"><?= $cat["ar_name"]; ?></h5>
                            <div class="flex-div">
                                <button class="btn round <?= $cat["status"] == 1 ? "btn-info" : "btn-secondary"; ?>"><i class="fas fa-ban"></i></button>
                                <button class="btn round <?= $cat["popular"] == 1 ? "btn-info" : "btn-secondary"; ?>"><i class="fas fa-ban"></i></button>
                                <button class="btn round btn-success"><a class="text-white" href="editCategory.php?id=<?= $cat["ID"] ?>"><i class="fas fa-pen"></i></a></button>
                                <button type="button" class="btn btn-danger round delete_category_btn" value="<?= $cat["ID"] ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
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
        echo "no categories";
    }
    ?>

</div>

<?php
include("includes/footer.php");
?>