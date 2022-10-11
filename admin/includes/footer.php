</div>
</div>
<script src="assets/js/jquery-3.6.1.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/owl.carousel.js"></script>
<script src="assets/js/wow.min.js"></script>
<!-- <script src="assets/js/sweetalert.js"></script> -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<script>
  new WOW().init();
  <?php
  if (isset($_SESSION["success"])) {
  ?>
    // alertify
    alertify.set('notifier', 'position', 'top-right');
    alertify.success("<?= $_SESSION["success"]; ?>");
  <?php
    unset($_SESSION["success"]);
  }
  ?>
 // sidenav
 function openNav() {
  document.getElementById("mySidenav").style.width = "220px";
  document.getElementById("main").style.marginLeft = "220px";
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
}
</script>
</body>

</html>