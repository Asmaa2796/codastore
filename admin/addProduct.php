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
        <h4 class="title"><i class="fas fa-caret-right"></i> Add product</h4>
        </div>
        <div class="col-md-6 text-right">
            <br>
            <a href="products.php" class="btn btn-dark text-white"><i class="fas fa-eye" style="font-size: small;"></i> View products</a>
        </div>
    </div>
    <form action="code.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <label>Select category</label>
                <select name="category_name">
                    <?php
                        $categories = getAll("categories");
                        if(mysqli_num_rows($categories) > 0) {
                            foreach($categories as $cat) {
                                ?>
                                    <option value="<?=$cat["ID"]?>"><?=$cat["name"]?></option>
                                <?php
                            }
                        } else {
                            echo "No categories exists";
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="col-md-6">
                <label>Arabic name</label>
                <input type="text" name="ar_name" required>
            </div>
            <div class="col-md-12">
                <label>Slug</label>
                <input type="text" name="slug" required>
            </div>
            <div class="col-md-6">
                <label>Small description</label>
                <textarea name="small_description" required></textarea>
            </div>
            <div class="col-md-6">
                <label>Arabic small description</label>
                <textarea name="ar_small_description" required></textarea>
            </div>
            <div class="col-md-6">
                <label>Description</label>
                <textarea name="description" required></textarea>
            </div>
            <div class="col-md-6">
                <label>Arabic description</label>
                <textarea name="ar_description" required></textarea>
            </div>
            <div class="col-md-6">
                <label>Original price</label>
                <input type="text" name="original_price" required>
            </div>
            <div class="col-md-6">
                <label>Selling price</label>
                <input type="text" name="selling_price" required>
            </div>
            <div class="col-md-12">
                <label>Quantity</label>
                <input type="number" name="qty" required>
            </div>
            <div class="col-md-12">
                <label>Meta title</label>
                <input type="text" name="meta_title">
            </div>
            <div class="col-md-12">
                <label>Meta description</label>
                <textarea name="meta_description"></textarea>
            </div>
            <div class="col-md-12">
                <label>Meta keywords</label>
                <textarea name="meta_keywords"></textarea>
            </div>
            <div class="col-md-6 col-6">
                <label>Status</label>
                <label class="contain no-label">
                    <input type="checkbox" name="status">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="col-md-6 col-6">
                <label>Trending</label>
                <label class="contain no-label">
                    <input type="checkbox" name="trending">
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
            </div>
        </div>

        <div class="text-center">
            <button type="submit" name="add_product" class="submit"> Save <i class="fas fa-check" style="font-size:small;"></i></button>
        </div>
    </form>
</div>

<?php
include("includes/footer.php");
?>