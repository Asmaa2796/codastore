<?php
session_start();
include("config/dbConnection.php");
$name = $email = $phone = $password = $cpassword = "";
// $errors = array("name" => "","email" => "","phone" => "","password" => "","cpassword" => "");
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
// check sign up
if(isset($_POST["signup"])) {

    if (empty($_POST['name'])) {
        $_SESSION['name'] = $sitelang["Please fill this mandatory field"];
    } else {
        $name = $_POST['name'];
        if (!preg_match('/[A-Za-z0-9 _]/', $name)) {
            $_SESSION['name'] = $sitelang["Invalid characters"];
        }
    }
    if (empty($_POST['email'])) {
        $_SESSION['email'] = $sitelang["Please fill this mandatory field"];
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['email'] = $sitelang["Please type email correctly example@gmail.com"];
        }
    }

    if (empty($_POST['phone'])) {
        $_SESSION['phone'] = $sitelang["Please fill this mandatory field"];
    } else {
        $phone = $_POST['phone'];
        if (strlen($phone) < 11) {
            $_SESSION['phone'] = $sitelang["Phone must be 11 character"];
        }
        else if (strlen($phone) > 11) {
            $_SESSION['phone'] = $sitelang["Phone must be 11 character"];
        }
     
    }

    if (empty($_POST['password'])) {
        $_SESSION['password'] = $sitelang["Please fill this mandatory field"];
    } else {
        $password = $_POST['password'];
        if (!preg_match('/[A-Za-z0-9 _]/', $password)) {
            $_SESSION['password'] = $sitelang["Invalid characters"];
        }
    }
    if (empty($_POST['cpassword'])) {
        $_SESSION['cpassword'] = $sitelang["Please fill this mandatory field"];
    } else {
        $cpassword = $_POST['cpassword'];
        if (!preg_match('/[A-Za-z0-9 _]/', $cpassword)) {
            $_SESSION['cpassword'] = $sitelang["Invalid characters"];
        }
    }
    if ($_POST['password'] !== $_POST['cpassword']) {
        $_SESSION['cpassword'] = $sitelang["Password & Confirm password must be matched"];
    }

    $check_email_exists = "SELECT email FROM users WHERE email='$email'";
    $check_email_exists_run = mysqli_query($conn,$check_email_exists);

    if(mysqli_num_rows($check_email_exists_run) > 0) {
        $_SESSION["email"] = $sitelang["Email already exists"];
    }

    
    else {
        if($name != "" && $email != "" && $phone != "" && $password != "" && $cpassword != "") {
            // protect database from harmful data
            $name = mysqli_real_escape_string($conn,$_POST["name"]);
            $email = mysqli_real_escape_string($conn,$_POST["email"]);
            $phone = mysqli_real_escape_string($conn,$_POST["phone"]);
            $password = mysqli_real_escape_string($conn,$_POST["password"]);
            $cpassword = mysqli_real_escape_string($conn,$_POST["cpassword"]);

            $sql = "INSERT INTO users(name,phone,email,password,add_date) VALUES ('$name','$phone','$email','$password',NOW()) ";
            if (mysqli_query($conn, $sql)) {
                header("location: signin.php");
            } else {
                echo "Error :" . mysqli_error($conn);
            }
        }
        
    }
}

// check sign in
else if(isset($_POST["signin"])) {

    // protect database from harmful data
    $email = mysqli_real_escape_string($conn,$_POST["email"]);
    $password = mysqli_real_escape_string($conn,$_POST["password"]);

    $sql_signin = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $sql_signin_qry = mysqli_query($conn, $sql_signin);

    if (mysqli_num_rows($sql_signin_qry) > 0) {
        
        $_SESSION["auth"] = true;
        $userData = mysqli_fetch_array($sql_signin_qry);
        $user_id = $userData['ID'];
        $username = $userData['name'];
        $useremail = $userData['email'];
        $admin = $userData['admin'];
        $_SESSION["auth_user"] = [
            "ID" => $user_id,
            "name" => $username,
            "email" => $useremail
        ];
        $_SESSION["admin"] = $admin;

        if($admin == 1) {
            header("Location: admin/index.php");
        } else {
            
            header("Location: index.php");
        }

    }
    else {
        $_SESSION["message"] = $sitelang["Please enter email & password correctly"];
    }
 
}

?>