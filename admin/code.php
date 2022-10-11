<?php
session_start();
include("../config/dbConnection.php");
include("../functions/myfunctions.php");

if (isset($_POST["add_category"])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $ar_name = mysqli_real_escape_string($conn, $_POST["ar_name"]);
    $slug = mysqli_real_escape_string($conn, $_POST["slug"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $ar_description = mysqli_real_escape_string($conn, $_POST["ar_description"]);
    $meta_title = mysqli_real_escape_string($conn, $_POST["meta_title"]);
    $meta_description = mysqli_real_escape_string($conn, $_POST["meta_description"]);
    $meta_keywords = mysqli_real_escape_string($conn, $_POST["meta_keywords"]);
    $status = isset($_POST["status"]) ? "1" : "0";
    $popular = isset($_POST["popular"]) ? "1" : "0";
    $photo = $_FILES["photo"]["name"];
    $path = "../uploads";
    $basename = basename($photo);
    $originalPath = $path . '/' . $basename;
    $img_ext = pathinfo($originalPath, PATHINFO_EXTENSION);
    $file_name = time() . '.' . $img_ext;


    $cat_query = "INSERT INTO categories
     (name,ar_name,slug,description,ar_description,status,popular,photo,meta_title,meta_description,meta_keywords,addDate) VALUES ('$name','$ar_name','$slug','$description','$ar_description','$status','$popular','$photo','$meta_title','$meta_description','$meta_keywords',NOW())";

    $cat_qry_run = mysqli_query($conn, $cat_query);

    if ($cat_qry_run) {
        move_uploaded_file($_FILES['photo']['tmp_name'], $originalPath);
        $_SESSION["success"] = "Category added successfully";
        header("location: addCategory.php");
    } else {
        redirect("addCategory.php", "Something went wrong");
    }
}
else if (isset($_POST["update_category"])) {
    $cat_id = $_POST["cat_id"];
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $ar_name = mysqli_real_escape_string($conn, $_POST["ar_name"]);
    $slug = mysqli_real_escape_string($conn, $_POST["slug"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $ar_description = mysqli_real_escape_string($conn, $_POST["ar_description"]);
    $meta_title = mysqli_real_escape_string($conn, $_POST["meta_title"]);
    $meta_description = mysqli_real_escape_string($conn, $_POST["meta_description"]);
    $meta_keywords = mysqli_real_escape_string($conn, $_POST["meta_keywords"]);
    $status = isset($_POST["status"]) ? "1" : "0";
    $popular = isset($_POST["popular"]) ? "1" : "0";
    $new_photo = $_FILES["photo"]["name"];
    $old_photo = $_POST["old_photo"];
    $path = "../uploads";
    $basename = basename($new_photo);
    $originalPath = $path . '/' . $basename;
    $img_ext = pathinfo($originalPath, PATHINFO_EXTENSION);
    $file_name = time() . '.' . $img_ext;

    if ($new_photo != "") {
        $update_file_name = $new_photo;
    } else {
        $update_file_name = $old_photo;
    }

    $update_query = "UPDATE categories SET name='$name',ar_name='$ar_name',slug='$slug',description='$description',ar_description='$ar_description',meta_title='$meta_title',meta_description='$meta_description',meta_keywords='$meta_keywords',status='$status',popular='$popular',photo='$update_file_name' WHERE id='$cat_id'";

    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run) {
        if ($_FILES["photo"]["name"] != "") {
            move_uploaded_file($_FILES['photo']['tmp_name'], $originalPath);
            if (file_exists("../uploads/" . $old_photo)) {
                unlink("../uploads/" . $old_photo);
            }
        }
        $_SESSION["success"] = "Category updated successfully";
        header("location: editCategory.php?id=$cat_id");
    } else {
        redirect("editCategory.php?id=$cat_id", "Something went wrong");
    }
}
else if(isset($_POST["delete_category_btn"])) {
    $category_id = mysqli_real_escape_string($conn,$_POST["category_id"]);
    $category_qry = "SELECT * FROM categories WHERE id='$category_id'";
    $category_qry_run = mysqli_query($conn,$category_qry);
    $category_data = mysqli_fetch_array($category_qry_run);
    $image = $category_data["photo"];

    $delete_category = "DELETE FROM categories WHERE id='$category_id'";
    $delete_category_run = mysqli_query($conn,$delete_category);
    if($delete_category_run) {
        // $_SESSION["success"] = "Category deleted successfully";
        // header("location: categories.php");
        echo 200;
        if (file_exists("../uploads/" . $image)) {
            unlink("../uploads/" . $image);
        }
    }
    else {
        // redirect("categories.php", "Something went wrong");
        echo 500;
    }
}
else if (isset($_POST["add_product"])) {
    $category_name = mysqli_real_escape_string($conn, $_POST["category_name"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $ar_name = mysqli_real_escape_string($conn, $_POST["ar_name"]);
    $slug = mysqli_real_escape_string($conn, $_POST["slug"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $ar_description = mysqli_real_escape_string($conn, $_POST["ar_description"]);
    $small_description = mysqli_real_escape_string($conn, $_POST["small_description"]);
    $ar_small_description = mysqli_real_escape_string($conn, $_POST["ar_small_description"]);
    $original_price = mysqli_real_escape_string($conn, $_POST["original_price"]);
    $selling_price = mysqli_real_escape_string($conn, $_POST["selling_price"]);
    $qty = mysqli_real_escape_string($conn, $_POST["qty"]);
    $meta_title = mysqli_real_escape_string($conn, $_POST["meta_title"]);
    $meta_description = mysqli_real_escape_string($conn, $_POST["meta_description"]);
    $meta_keywords = mysqli_real_escape_string($conn, $_POST["meta_keywords"]);
    $status = isset($_POST["status"]) ? "1" : "0";
    $trending = isset($_POST["trending"]) ? "1" : "0";
    $photo = $_FILES["photo"]["name"];
    $path = "../uploads";
    $basename = basename($photo);
    $originalPath = $path . '/' . $basename;
    $img_ext = pathinfo($originalPath, PATHINFO_EXTENSION);
    $file_name = time() . '.' . $img_ext;


    $product_query = "INSERT INTO products
    (category_name,name,ar_name,slug,small_description,ar_small_description,description,ar_description,original_price,selling_price,photo,qty,status,trending,meta_title,meta_description,meta_keywords,addDate)
    VALUES ('$category_name','$name','$ar_name','$slug','$small_description','$ar_small_description','$description','$ar_description','$original_price','$selling_price','$photo','$qty','$status','$trending','$meta_title','$meta_description','$meta_keywords',NOW())";

    $product_qry_run = mysqli_query($conn, $product_query);

    if ($product_qry_run) {
        move_uploaded_file($_FILES['photo']['tmp_name'], $originalPath);
        $_SESSION["success"] = "Product added successfully";
        header("location: addProduct.php");
    } else {
        redirect("addProduct.php", "Something went wrong");
    }

}
else if (isset($_POST["update_product"])) {
    $product_id = $_POST["product_id"];
    $category_name = mysqli_real_escape_string($conn, $_POST["category_name"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $ar_name = mysqli_real_escape_string($conn, $_POST["ar_name"]);
    $slug = mysqli_real_escape_string($conn, $_POST["slug"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $ar_description = mysqli_real_escape_string($conn, $_POST["ar_description"]);
    $small_description = mysqli_real_escape_string($conn, $_POST["small_description"]);
    $ar_small_description = mysqli_real_escape_string($conn, $_POST["ar_small_description"]);
    $original_price = mysqli_real_escape_string($conn, $_POST["original_price"]);
    $selling_price = mysqli_real_escape_string($conn, $_POST["selling_price"]);
    $qty = mysqli_real_escape_string($conn, $_POST["qty"]);
    $meta_title = mysqli_real_escape_string($conn, $_POST["meta_title"]);
    $meta_description = mysqli_real_escape_string($conn, $_POST["meta_description"]);
    $meta_keywords = mysqli_real_escape_string($conn, $_POST["meta_keywords"]);
    $status = isset($_POST["status"]) ? "1" : "0";
    $trending = isset($_POST["trending"]) ? "1" : "0";
    $new_photo = $_FILES["photo"]["name"];
    $old_photo = $_POST["old_photo"];
    $path = "../uploads";
    $basename = basename($new_photo);
    $originalPath = $path . '/' . $basename;
    $img_ext = pathinfo($originalPath, PATHINFO_EXTENSION);
    $file_name = time() . '.' . $img_ext;

    if ($new_photo != "") {
        $update_file_name = $new_photo;
    } else {
        $update_file_name = $old_photo;
    }

    $update_product_query = "UPDATE products SET category_name='$category_name',name='$name',ar_name='$ar_name',slug='$slug',small_description='$small_description',ar_small_description='$ar_small_description',description='$description',ar_description='$ar_description',original_price='$original_price',selling_price='$selling_price',photo='$update_file_name',qty='$qty',status='$status',trending='$trending',meta_title='$meta_title',meta_description='$meta_description',meta_keywords='$meta_keywords' WHERE id='$product_id'";

    $update_product_query_run = mysqli_query($conn, $update_product_query);

    if ($update_product_query_run) {
        if ($_FILES["photo"]["name"] != "") {
            move_uploaded_file($_FILES['photo']['tmp_name'], $originalPath);
            if (file_exists("../uploads/" . $old_photo)) {
                unlink("../uploads/" . $old_photo);
            }
        }
        $_SESSION["success"] = "Product updated successfully";
        header("location: editProduct.php?id=$product_id");
    } else {
        redirect("editProduct.php?id=$product_id", "Something went wrong");
    }
}
else if(isset($_POST["delete_product_btn"])) {
    $product_id = mysqli_real_escape_string($conn,$_POST["product_id"]);
    $product_qry = "SELECT * FROM products WHERE id='$product_id'";
    $product_qry_run = mysqli_query($conn,$product_qry);
    $product_data = mysqli_fetch_array($product_qry_run);
    $image = $product_data["photo"];

    $delete_product = "DELETE FROM products WHERE id='$product_id'";
    $delete_product_run = mysqli_query($conn,$delete_product);
    if($delete_product_run) {
        // $_SESSION["success"] = "Product deleted successfully";
        // header("location: products.php");
        echo 200;
        if (file_exists("../uploads/" . $image)) {
            unlink("../uploads/" . $image);
        }
    }
    else {
        // redirect("products.php", "Something went wrong");
        echo 500;
    }
}
else {
    header("location: ../index.php");
}
?>
