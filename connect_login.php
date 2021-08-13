<?php
session_start();
$valid = true;
$servername = "localhost: 3306";
$username = "root";
$pass = "";
$database_name = "Email_Server";

$con = new mysqli($servername, $username, $pass, $database_name); //server connection
if($con-> connect_error) //failed to connect
    die("failed to connect to database: ".$con-> connect_error);

$v_email = $_COOKIE["v_userEmailCookie"];
$v_password = $_COOKIE["v_userPasswordCookie"];
$sql = "SELECT * FROM user WHERE Email_address = '".$v_email."' AND Password = '".$v_password."'";
$res = $con->query($sql);
if($res->num_rows > 0){
    $_SESSION['user_email'] = $v_email;
    header('LOCATION: profile.php');
}
else {
    $_SESSION["messages"][] = "Wrong email or password!";
    header('LOCATION: login.php');
    exit;
}
?>
