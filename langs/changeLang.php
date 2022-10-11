<?php
$_SERVER['REQUEST_URI'] = str_replace(array("?lang=","&lang=","en","ar"),"",$_SERVER['REQUEST_URI']);

if (!isset($_GET['lang'])) {
  $_GET['lang'] = "en";
}
elseif ( $_GET["lang"] == "ar" )
{
  $_SESSION["lang"] = "ar";
}
elseif ( $_GET["lang"] == "en" )
{
  $_SESSION["lang"] = "en";
}
$_SESSION["lang"] = ( $_SESSION["lang"]?$_SESSION["lang"]:"ar");
$lang = ($_SESSION["lang"] == "en"?"ar":"en");
if ( strpos($_SERVER['REQUEST_URI'],"?") )
{
  $URL = $_SERVER['REQUEST_URI']."&lang=$lang";
}
else {
  $URL = "?lang=$lang";
}

if (  $_SESSION["lang"] == "ar" )
{
    require("langs/ar.php");
    $css_file = "ar.css";
    $alertify_file = "alertify.rtl.min.css";
    $bootstrap_file = "bootstrap.rtl.min.css";
    $js_file = "main-ar.js";
}
else 
{
    require("langs/en.php");
    $css_file = "style.css";
    $alertify_file = "alertify.min.css";
    $bootstrap_file = "bootstrapp.min.css";
    $js_file = "main.js";
}
?>