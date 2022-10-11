<?php
if(!isset($_SESSION["auth"])) {
    
    redirect("signin.php","Login to continue");

}
?>