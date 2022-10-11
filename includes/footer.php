<div class="scrollUp text-center">
  <i class="fas fa-angle-double-up"></i>
</div>
<footer class="pd">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-12">
        <h5><?=$sitelang["about us"]?></h5>
        <p>
          <?=$sitelang["lorem"]?>
        </p>
      </div>
      <div class="col-lg-3 col-md-6 col-12">
        <h5><?=$sitelang["newsletter"]?></h5>
        <span><?=$sitelang["stay updated with our latest trends"]?></span>
        <form action="">
          <input type="email" name="" id="" placeholder="<?=$sitelang["email"]?>">
          <button><i class="fas fa-arrow-right"></i></button>
        </form>
      </div>
      <div class="col-lg-3 col-md-6 col-12">
        <h5><?=$sitelang["important links"]?></h5>
        <div class="links">
          <a href="index.php"><?=$sitelang["home"]?></a>
          <a href="services.php"><?=$sitelang["services"]?></a>
          <a href="categories.php"><?=$sitelang["categories"]?></a>
          <a href="products.php"><?=$sitelang["products"]?></a>
          <a href="contactUs.php"><?=$sitelang["contact_us"]?></a>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-12">
        <h5><?=$sitelang["follow us"]?></h5>
        <div class="social">
          <a href=""><i class="fab fa-facebook-f"></i></a>
          <a href="https://www.behance.net/asmaasaad7"><i class="fab fa-behance"></i></a>
          <a href=""><i class="fas fa-phone"></i></a>
          <a href=""><i class="fas fa-envelope"></i></a>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-12 top-bar bg-white">
        <ul class="list-unstyled ul1 pr-0">
              <li><a href=""><?=$sitelang["Privacy policy"]?></a></li>
              <li>|</li>
              <li><a href=""><?=$sitelang["Terms_conditions"]?></a></li>
              <li>|</li>
              <li><a href=""><?=$sitelang["Call us"]?></a></li>
            </ul>
        <hr>
        <b class="text-center d-block"><?=$sitelang["copyright ©2022 All rights reserved"]?> &copy; 2022 | Asmaa saad</b>
      </div>
    </div>
  </div>
</footer>
<script src="assets/js/jquery-3.6.1.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/owl.carousel.js"></script>
  <script src="assets/js/wow.min.js"></script>
  <script src="assets/js/<?=$js_file?>"></script>
  <script src="assets/js/alertify.min.js"></script>
  <!-- <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script> -->
  <script>
      new WOW().init(); 
      alertify.set('notifier','position', 'top-right');
      <?php
      if(isset($_SESSION["success"])) {
          ?>
          // alertify
          alertify.success("<?= $_SESSION["success"] ;?>");
          <?php
          unset($_SESSION["success"]);
      }
      ?>
  </script>
</body>
</html>