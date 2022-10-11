<?php
include("config/dbConnection.php");

function getAllActive($table) {
    global $conn;
    $query = "SELECT * FROM $table ORDER BY ID DESC";
    return $query_run = mysqli_query($conn,$query);

}
function getIDActive($table,$id) {
    global $conn;
    $query = "SELECT * FROM $table WHERE id='$id'";
    return $query_run = mysqli_query($conn,$query);

}
function getSlugActive($table,$slug) {
    global $conn;
    $query = "SELECT * FROM $table WHERE slug='$slug'";
    return $query_run = mysqli_query($conn,$query);

}
function getProductByCategory($category_name,$id) {
    global $conn;
    $query = "SELECT * FROM products WHERE category_name='$category_name' AND ID!='$id'";
    return $query_run = mysqli_query($conn,$query);

}

function getCartItems() {
    global $conn;
    $userId = $_SESSION["auth_user"]["ID"];
    $query = "SELECT c.ID as cid, c.product_id, c.product_qty, p.ID as pid, p.name,p.ar_name, p.photo,p.qty, p.selling_price FROM cart c, products p WHERE c.product_id=p.ID AND c.user_id='$userId' ORDER BY c.ID DESC";
    return $query_run = mysqli_query($conn,$query);
}

function getOrders() {
    global $conn;
    $userId = $_SESSION["auth_user"]["ID"];
    $query = "SELECT * FROM orders WHERE user_id='$userId'";
    return $query_run = mysqli_query($conn,$query);
}


function chkTrNoValid($tracking_no) {
    global $conn;
    $userId = $_SESSION["auth_user"]["ID"];
    $query = "SELECT * FROM orders WHERE tracking_no='$tracking_no' AND user_id='$userId'";
    return $query_run = mysqli_query($conn,$query);
}
?>