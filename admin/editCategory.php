<?php
include("includes/navbar.php");
include("../middleware/adminMiddleware.php");
?>

<div class="add pd">
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
            <h4 class="title"><i class="fas fa-caret-right"></i> Edit category</h4>
        </div>
        <div class="col-md-6 text-right">
            <br>
            <a href="categories.php" class="btn btn-dark text-white"><i class="fas fa-eye"></i> View categories</a>
        </div>
    </div>
    <?php
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $category = getByID("categories",$id);
        if(mysqli_num_rows($category) > 0) {
            $row = mysqli_fetch_array($category);
        ?>
            <form action="code.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <label>Name</label>
                        <input type="hidden" name="cat_id" value="<?=$row["ID"]?>">
                        <input type="text" name="name" value="<?=$row["name"]?>" required value="">
                    </div>
                    <div class="col-md-6">
                        <label>Arabic name</label>
                        <input type="text" name="ar_name" value="<?= $row["ar_name"] ?>" required value="">
                    </div>
                    <div class="col-md-12">
                        <label>Slug</label>
                        <input type="text" name="slug" value="<?=$row["slug"]?>" required value="">
                    </div>
                    <div class="col-md-12">
                        <label>Description</label>
                        <textarea name="description" required><?=$row["description"]?></textarea>
                    </div>
                    <div class="col-md-12">
                        <label>Arabic description</label>
                        <textarea name="ar_description" required><?=$row["ar_description"]?></textarea>
                    </div>
                    <div class="col-md-12">
                        <label>Meta title</label>
                        <input type="text" name="meta_title" value="<?=$row["meta_title"]?>" value="">
                    </div>
                    <div class="col-md-12">
                        <label>Meta description</label>
                        <textarea name="meta_description"><?=$row["meta_description"]?></textarea>
                    </div>
                    <div class="col-md-12">
                        <label>Meta keywords</label>
                        <textarea name="meta_keywords"><?=$row["meta_keywords"]?></textarea>
                    </div>
                    <div class="col-md-6 col-6">
                        <label>Status</label>
                        <label class="contain no-label">
                            <input type="checkbox" <?=$row["status"] ? "checked":""?> name="status">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-6 col-6">
                        <label>Popular</label>
                        <label class="contain no-label">
                            <input type="checkbox" name="popular" <?=$row["popular"] ? "checked":""?>>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-12">
                        <label class="no-label"> Upload photo </label>
                        <div class='file file--upload'>
                            <label for='input-file' class="no-label">
                                <i class="fas fa-upload"></i> Upload photo
                            </label>
                            <input id='input-file' name="photo" type='file' />
                        </div>
                        <p class="font-italic"><small>Current photo</small></p>
                        <input type="hidden" name="old_photo" value="<?=$row["photo"]?>">
                        <img src="../uploads/<?=$row["photo"]?>" onerror="src='assets/images/no-image.jpg'" width="50px" height="50px" alt="">
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" name="update_category" class="submit"> Update <i class="fas fa-check" style="font-size:small;"></i></button>
                </div>
            </form>
        <?php
        }
        else {
            echo "Category not found";
        }
    } 
    else {
        echo "Something went wrong, missing ID";
    }
    ?>
</div>

<?php
include("includes/footer.php");
?>