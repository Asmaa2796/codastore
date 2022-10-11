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
                <div class="card">
                    <div class="card-body add">
                    <h4 style="margin-bottom: 0;color:var(--colorr)" class="text-center"><?=$sitelang["signup"]?></h4>
                        <form action="signup.php" method="post">
                            <div class="form-group">
                                <label><?=$sitelang["name"]?></label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($name) ?>" name="name">
                                <?php
                                if (isset($_SESSION["name"])) {
                                ?>
                                    <div class="alert alert-warning text-valid" role="alert">
                                        <?= $_SESSION['name']; ?>
                                    </div>
                                <?php
                                    unset($_SESSION["name"]);
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label><?=$sitelang["email"]?></label>
                                <input type="email" class="form-control" inputmode="email" value="<?= htmlspecialchars($email) ?>" name="email">
                                <?php
                                if (isset($_SESSION["email"])) {
                                ?>
                                    <div class="alert alert-warning text-valid" role="alert">
                                        <?= $_SESSION['email']; ?>
                                    </div>
                                <?php
                                    unset($_SESSION["email"]);
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label><?=$sitelang["phone"]?></label>
                                <input type="number" class="form-control" inputmode="numeric" value="<?= htmlspecialchars($phone) ?>" name="phone">
                                <?php
                                if (isset($_SESSION["phone"])) {
                                ?>
                                    <div class="alert alert-warning text-valid" role="alert">
                                        <?= $_SESSION['phone']; ?>
                                    </div>
                                <?php
                                    unset($_SESSION["phone"]);
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label><?=$sitelang["password"]?></label>
                                <input type="password" class="form-control" value="<?= htmlspecialchars($password) ?>" name="password">
                                <?php
                                if (isset($_SESSION["password"])) {
                                ?>
                                    <div class="alert alert-warning text-valid" role="alert">
                                        <?= $_SESSION['password']; ?>
                                    </div>
                                <?php
                                    unset($_SESSION["password"]);
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label><?=$sitelang["confirm password"]?></label>
                                <input type="password" class="form-control" value="<?= htmlspecialchars($cpassword) ?>" name="cpassword">
                                <?php
                                if (isset($_SESSION["cpassword"])) {
                                ?>
                                    <div class="alert alert-warning text-valid" role="alert">
                                        <?= $_SESSION['cpassword']; ?>
                                    </div>
                                <?php
                                    unset($_SESSION["cpassword"]);
                                }
                                ?>
                            </div>
                            <div class="text-center">                            
                                <button type="submit" name="signup" class="custom-btn"><?=$sitelang["signup"]?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <img class="mx-auto d-block" style="width: 80%;" src="assets/images/Signup-rafiki.png" alt="">
            </div>
        </div>
    </div>
</div>
<?php
include("includes/footer.php");
?>