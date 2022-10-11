<?php
session_start();
include("../config/dbConnection.php");

if(isset($_SESSION["auth"])) {
    if(isset($_POST["scope"])) {
        $scope = $_POST["scope"];
        switch($scope) {
            case "add";
                $product_id = $_POST["product_id"];
                $product_qty = $_POST["product_qty"];

                $user_id = $_SESSION["auth_user"]["ID"];

                $chk_exist_product = "SELECT * FROM cart WHERE product_id='$product_id' AND user_id='$user_id'";
                $chk_exist_product_run = mysqli_query($conn,$chk_exist_product);
                if(mysqli_num_rows($chk_exist_product_run) > 0) {
                    
                    echo "existing";
                } 
                else {
                    $cart_qry = "INSERT INTO cart (user_id,product_id,product_qty,addDate) VALUES ('$user_id','$product_id','$product_qty',NOW())";
                    $cart_qry_run = mysqli_query($conn,$cart_qry);
                    if($cart_qry_run) {
                        echo 201;
                    }
                    else {
                        echo 500;
                    }
                }
                break;
            case "update":
                $product_id = $_POST["product_id"];
                $product_qty = $_POST["product_qty"];

                $user_id = $_SESSION["auth_user"]["ID"];
                $chk_exist_product = "SELECT * FROM cart WHERE product_id='$product_id' AND user_id='$user_id'";
                $chk_exist_product_run = mysqli_query($conn,$chk_exist_product);
                if(mysqli_num_rows($chk_exist_product_run) > 0) {
                    
                    $update_qry = "UPDATE cart SET product_qty='$product_qty' WHERE product_id='$product_id' AND user_id='$user_id'";
                    $update_qry_run = mysqli_query($conn,$update_qry);
                    if($update_qry_run) {
                        echo 201;
                    }
                    else {
                        echo 500;
                    }
                } 
                else {
                   echo "Something went wrong";
                }
                break;
            case "delete":
                $cart_id = $_POST["cart_id"];
                $user_id = $_SESSION["auth_user"]["ID"];
                
                $chk_exist_product = "SELECT * FROM cart WHERE ID='$cart_id' AND user_id='$user_id'";
                $chk_exist_product_run = mysqli_query($conn,$chk_exist_product);
                if(mysqli_num_rows($chk_exist_product_run) > 0) {
                    
                    $delete_qry = "DELETE FROM cart WHERE ID='$cart_id'";
                    $delete_qry_run = mysqli_query($conn,$delete_qry);
                    if($delete_qry_run) {
                        echo 201;
                    }
                    else {
                        echo 500;
                    }
                } 
                else {
                   echo "Something went wrong";
                }
                break;
            default:
                echo 500;
        }
    }
}
else {
    echo 401;
}
?>