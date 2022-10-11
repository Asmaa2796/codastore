<?php
include("functions/authCode.php");
include("langs/changeLang.php");
include("functions/userfunctions.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#0055EB" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/owl.carousel.css">
  <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="assets/css/<?= $bootstrap_file ?>" />
  <link rel="stylesheet" href="assets/css/<?= $alertify_file ?>" />
  <link rel="stylesheet" href="assets/css/<?= $css_file ?>">
  <title><?=$sitelang["coda store"]?></title>
</head>

<body>
  <div class="top">
    <div class="top-bar">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <ul class="list-unstyled ul1 ul3 pd-0">
              <li><a href=""><?=$sitelang["Privacy policy"]?></a></li>
              <li>|</li>
              <li><a href=""><?=$sitelang["Terms_conditions"]?></a></li>
              <li>|</li>
              <li><a href=""><?=$sitelang["Call us"]?></a></li>
            </ul>
          </div>
          <div class="col-md-6">
            <div class="div-text pt-2">
              <div class="options">
                <?php
                if (isset($_SESSION["auth"])) {
                  
                  $cart = getCartItems();
                  ?>
                    <div class="li-cart"><img src="assets/images/shopping-cart.png" alt=""> <span><?= mysqli_num_rows($cart) > 0 ? mysqli_num_rows($cart) : "0" ?></span></div>
                  <?php
                }
                ?>
                <div class="langs">
                  <a href="<?= $URL ?>" class="btn btn-sm text-white mb-1"><?= $sitelang["language"] ?></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <nav class="navbar navbar-expand-lg py-4">
      <div class="container">
        <a class="navbar-brand" href="index.php"><img src="assets/images/logo.png" alt=""> <b><?=$sitelang["coda store"]?></b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon text-primary mt-2"><i class="fas fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php"><?= $sitelang["home"] ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href=""><?= $sitelang["services"] ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="categories.php"><?= $sitelang["categories"] ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="products.php"><?= $sitelang["products"] ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href=""><?= $sitelang["contact_us"] ?></a>
            </li>
            <?php
            if (isset($_SESSION["auth"]) == true) {
            ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?= $_SESSION["auth_user"]["name"]; ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <?php
                  if ($_SESSION["admin"] == 1) {
                  ?>
                    <a class="dropdown-item" href="admin/index.php"> <?= $sitelang["admin_dashboard"] ?></a>
                  <?php
                  }
                  ?>
                  <a class="dropdown-item" href="#"> <?= $sitelang["myAccount"] ?></a>
                  <a class="dropdown-item" href="myOrders.php"><?= $sitelang["myOrders"] ?></a>
                  <a class="dropdown-item" href="logout.php"><?= $sitelang["logout"] ?></a>
                </div>
              </li>
            <?php
            } else {
            ?>
              <li class="nav-item">
                <a class="nav-link" href="signin.php"><?= $sitelang["signin"] ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="signup.php"><?= $sitelang["signup"] ?></a>
              </li>
            <?php
            }
            ?>
          </ul>
          <ul class="list-unstyled ul2">
            <li class="wow fadeInLeft" data-wow-duration=".6s" data-wow-offset="100"><a href=""> <i class="fab fa-facebook-f"></i></a></li>
            <li class="wow fadeInLeft" data-wow-duration=".6s" data-wow-offset="100" data-wow-delay=".5s"><a href="https://www.behance.net/asmaasaad7"> <i class="fab fa-behance"></i></a></li>
            <li class="wow fadeInLeft" data-wow-duration=".6s" data-wow-offset="100" data-wow-delay=".8s"><a href=""> <i class="fas fa-envelope"></i></a></li>
            <li class="wow fadeInLeft" data-wow-duration=".6s" data-wow-offset="100" data-wow-delay="1s"><a href=""><i class="fas fa-phone"></i></a></li>
          </ul>
        </div>
      </div>
    </nav>
  </div>

 
  <div class="side-container">
    <div class="overlay"></div>
    <div class="side-menu pb-5">
      <div class="container">
        <div class="img">
          <div class="times"><i class="fas fa-times"></i></div>
        </div>
        <div class="cart_table">
          <?php
          if (mysqli_num_rows($cart) > 0) {
          ?>
            <h5><?=$sitelang["shopping cart"]?></h5>
            <hr>
            <?php
            foreach ($cart as $cartItem) {
            ?>
              <div class="product_data">
                <div class="row" style="width: 100%;">
                  <div class="col-md-3 col-3">
                    <img src="uploads/<?= $cartItem["photo"] ?>" onerror="src='assets/images/no-image.jpg'" alt="">
                  </div>
                  <div class="col-md-7 col-7">
                    <p><?= $cartItem[$sitelang["prefix"]."name"] ?></p>
                    <b><?= number_format($cartItem["selling_price"]) ?> <?=$sitelang["currency"]?></b>
                  </div>
                  <div class="col-md-2 col-2">
                    <button class="btn btn-sm btn-danger delete_item" value="<?= $cartItem["cid"] ?>"><i class="fas fa-trash fa-sm me-2"></i></button>
                  </div>
                  <div class="col-md-12 col-12">
                    <hr>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
            <div class="">
              <a href="cart.php" class="view-cart"><?=$sitelang["view shopping cart"]?></a>
            </div>
          <?php
          } else {
          ?>
            <div class="py-4 text-center my-4">
                    <img src="assets/images/cartempty.png" class="d-block mx-auto my-2" style="width: auto;height: 170px;" alt="">
                    <h4 class="my-4 d-block"><?=$sitelang["no items in cart"]?></h4>
                    <a href="products.php" class="custom-btn"><?=$sitelang["shop now"]?></a>
                </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  
  <!-- loading -->
  <div class="loading-overlay">
  <img src="assets/images/cart-icon-loader.gif" alt="">
</div>