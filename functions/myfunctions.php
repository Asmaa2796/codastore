<?php
include("../config/dbConnection.php");

function getAll($table) {
    global $conn;
    $query = "SELECT * FROM $table ORDER BY ID DESC";
    return $query_run = mysqli_query($conn,$query);
}
function getByID($table,$id) {
    global $conn;
    $query = "SELECT * FROM $table WHERE id='$id'";
    return $query_run = mysqli_query($conn,$query);

}

function redirect($url,$message) {
    $_SESSION["message"] = $message;
    header("location: ".$url);
    exit();
}
?>