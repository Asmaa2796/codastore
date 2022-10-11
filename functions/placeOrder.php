<?php
session_start();
include("../config/dbConnection.php");
if (  $_SESSION["lang"] == "ar" )
{
    require("../langs/ar.php");
    $css_file = "ar.css";
    $alertify_file = "alertify.rtl.min.css";
    $bootstrap_file = "bootstrap.rtl.min.css";
    $js_file = "main-ar.js";
}
else 
{
    require("../langs/en.php");
    $css_file = "style.css";
    $alertify_file = "alertify.min.css";
    $bootstrap_file = "bootstrapp.min.css";
    $js_file = "main.js";
}
if(isset($_SESSION["auth"])) {
    if(isset($_POST["place_order"])) {
        $name = mysqli_real_escape_string($conn,$_POST["name"]);
        $email = mysqli_real_escape_string($conn,$_POST["email"]);
        $phone = mysqli_real_escape_string($conn,$_POST["phone"]);
        $pincode = mysqli_real_escape_string($conn,$_POST["pincode"]);
        $address = mysqli_real_escape_string($conn,$_POST["address"]);
        $payment_method = mysqli_real_escape_string($conn,$_POST["payment_method"]);
        $payment_id = mysqli_real_escape_string($conn,$_POST["payment_id"]);

        if($name == "" || $email == "" || $phone == "" || $pincode == "" || $address == "" ) {
            $_SESSION["message"] = $sitelang["all fields are mandatory"];
            header("location: ../checkout.php");
            exit(0);
        }
        else {
            $user_id = $_SESSION["auth_user"]["ID"];
            $query = "SELECT c.ID as cid, c.product_id, c.product_qty, p.ID as pid, p.name, p.photo, p.selling_price FROM cart c, products p WHERE c.product_id=p.ID AND c.user_id='$user_id' ORDER BY c.ID DESC";
            $query_run = mysqli_query($conn,$query);
            $total = 0;
            foreach ($query_run as $cartItem)
            {
                $total += $cartItem["selling_price"] * ($cartItem["product_qty"]?$cartItem["product_qty"]:"1");
            }
            $tracking_no = "codegeek".rand(1111,9999);
            // $tracking_no = "codegeek".rand(1111,9999).substr($phone,2);
            $insert_order = "INSERT INTO orders (tracking_no,user_id,name,email,phone,pincode,address,total_price,payment_method,payment_id,addDate) VALUES ('$tracking_no','$user_id','$name','$email','$phone','$pincode','$address','$total','$payment_method','$payment_id',NOW())";
            $insert_order_run = mysqli_query($conn,$insert_order);
            if($insert_order_run) {
                $order_id = mysqli_insert_id($conn);
                foreach ($query_run as $cartItem)
                    {
                        $prod_id = $cartItem["product_id"];
                        $prod_qty = $cartItem["product_qty"];
                        $price = $cartItem["selling_price"];
                        $order_items_qry = "INSERT INTO order_items (order_id,product_id,qty,price) VALUES ('$order_id','$prod_id','$prod_qty','$price')";
                        $order_items_qry_run = mysqli_query($conn,$order_items_qry);
                        
                        $product_qry = "SELECT * FROM products WHERE ID='$prod_id'";
                        $product_qry_run = mysqli_query($conn,$product_qry);
                        $fetch_product = mysqli_fetch_array($product_qry_run);
                        $current_qty = $fetch_product["qty"];

                        // calculate items count for product
                        $new_qty = $current_qty - $prod_qty;

                        $update_qry = "UPDATE products SET qty='$new_qty' WHERE ID='$prod_id'";
                        $update_qry_run = mysqli_query($conn,$update_qry);
                    }

                $deleteCart_qry = "DELETE FROM cart WHERE user_id='$user_id'";
                $deleteCart_run = mysqli_query($conn,$deleteCart_qry);

                $_SESSION["success"] = $sitelang["Order placed successfully"];
                header("location: ../myOrders.php");
                die();
            } 
            else {
                echo $sitelang["something went wrong"];
            }
        }
    }
} else {
    header("location: ../index.php");
}
?>