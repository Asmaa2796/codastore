<?php
include("../functions/myfunctions.php");

if(isset($_SESSION["auth"])) {
    
    if($_SESSION["admin"] != 1) {
        redirect("../index.php","You are not authorized to access this page");
    }

} else {
    redirect("../signin.php","Login to continue");
}

?>