<?php
session_start();
$servername = "localhost: 3306";
$username = "root";
$pass = "";
$database_name = "Email_Server";

try {
    $conn = new mysqli($servername, $username, $pass, $database_name); //server connection
    if ($conn->connect_error) //failed to connect
        die("failed to connect to database: " . $conn->connect_error);

    $user_email = $_SESSION['user_email'];
    $user_first_name = $user_last_name = "";


    $get_user_info = "SELECT $user_first_name = u.First_name, $user_last_name = u.Last_name FROM user u WHERE u.Email_address= '" . $user_email . "'";
    $res = $conn->query($get_user_info);
    if ($res->num_rows > 0) {
        echo $user_first_name . "</br>" .$user_first_name;

        //    header('LOCATION: profile.php');
    } else {
        $_SESSION["messages"][] = "Can't find user!!";
        header('LOCATION: login.php');
        exit;
    }
}
catch (mysqliException $exception){
    $_SESSION['messages'][] = 'Connection failed' . $exception->getMessage();
    header('LOCATION: login.php');
    exit();
}









