<?php
session_start();
$page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/owl.carousel.css">
  <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <!-- <link rel="stylesheet" href="assets/css/sweetalert.css"> -->
  <link rel="stylesheet" href="assets/css/style.css">
  <title>CoDa Store | Admin dashboard</title>
</head>
<body>
  <!-- side navbar -->
  <div class="side-navbar" id="mySidenav">
    <div class="user">
      <img src="assets/images/user.png" alt="">
      <b><?= $_SESSION["auth_user"]["name"] ?></b>
    </div>
    <hr>
    <div class="links">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <ul class="list-unstyled">
        <li><a class="<?= $page == "index.php" ? "active" : '' ?>" href="index.php"><img src="assets/images/home.png" alt=""> Home</a></li>
        <li><a class="<?= $page == "categories.php" || $page == "addCategory.php" || $page == "editCategory.php" ? "active" : "" ?>" href="categories.php"><img src="assets/images/categories.png" alt=""> Categories</a></li>
        <li><a class="<?= $page == "products.php" || $page == "addProduct.php" || $page == "editProduct.php" ? "active" : "" ?>" href="products.php"><img src="assets/images/box.png" alt=""> Products</a></li>
        <li><a class="<?= $page == "settings.php" ? "active" : "" ?>" href="settings.php"><img src="assets/images/settings.png" alt=""> Settings</a></li>
      </ul>
    </div>
    <hr class="mb-3">
    <a href="../logout.php" class="text-white text-center logout"> <img style="width: 17px;" src="assets/images/quit.png" alt="">&nbsp;Logout</a>
  </div>
  <div class="container py-3">
    <div id="main">
      <div class="top-bar text-right bg-light py-2 px-3 mb-4 border">
        <span class="text-primary float-left" style="cursor:pointer;" onclick="openNav()">☰</span>
        <b> <?= $_SESSION["auth_user"]["name"] ?> <img src="assets/images/user.png" style="width: 25px;"/></b>
      </div> 