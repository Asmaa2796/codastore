<?php
     
    $dbHost = "sql101.epizy.com";
    $dbUsername = "epiz_32633766";
    $dbPassword = "ONi14nVhEUKH2";
    $dbDatabase = "epiz_32633766_codastore";

    $conn = mysqli_connect($dbHost,$dbUsername,$dbPassword,$dbDatabase);

    if(!$conn) {
        echo "connection failed";
    }
?>