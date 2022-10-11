<?php
// session_start();
// // session auth == true
// if(isset($_SESSION["auth"])) {
//     header("location: index.php");
// }
include("includes/header.php");
?>
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
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
                <div class="card">
                    <div class="card-body add">
                        <h4 style="margin-bottom: 0;color:var(--colorr)" class="text-center"><?=$sitelang["signin"]?></h4>
                        <form action="signin.php" method="post">
                            <div class="form-group">
                                <label><?=$sitelang["email"]?></label>
                                <input type="email" required class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label><?=$sitelang["password"]?></label>
                                <input type="password" required class="form-control" name="password">
                            </div>
                            <div class="text-center">                            
                                <button type="submit" name="signin" class="custom-btn"><?=$sitelang["signin"]?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <img class="mx-auto d-block" style="width: 80%;" src="assets/images/Privacypolicy-rafiki.png" alt="">
            </div>
        </div>
    </div>
</div>
<?php
include("includes/footer.php");
?>