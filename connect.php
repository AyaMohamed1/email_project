<?php
session_start();
$valid = true;
$servername = "localhost: 3306";
$username = "root";
$pass = "";
$database_name = "Email_Server";

try {
    $conn = new mysqli($servername, $username, $pass, $database_name); //server connection
    if ($conn->connect_error) //failed to connect
        die("failed to connect to database: " . $conn->connect_error);

    //$insert_in_table = $conn->prepare('INSERT INTO user (Email_address, First_name, Last_name, Password)
    //                            VALUES (?,?,?,?)');
    //$insert_in_table->bind_param("ssss", $user_email_address, $user_first_name, $user_last_name, $user_password);
    $user_email_address = $_COOKIE["userEmailCookie"];
    $user_first_name = $_COOKIE["userFirstNameCookie"];
    $user_last_name = $_COOKIE["userLastNameCookie"];
    $user_password = $_COOKIE["userPasswordCookie"];


    //$insert_in_table->execute();
    //$insert_in_table->close();
    //echo "user added";

    $check_user_email = "SELECT * FROM user WHERE Email_address= '" . $user_email_address . "'";
    $res = $conn->query($check_user_email);
    if ($res->num_rows > 0) {
        $_SESSION["messages"][] = "Used email! Please choose another one.";
        header('LOCATION: register.php');
        exit;
    } else {
        $insert_in_table = $conn->prepare('INSERT INTO user (Email_address, First_name, Last_name, Password)
                                VALUES (?,?,?,?)');
        $insert_in_table->bind_param("ssss", $user_email_address, $user_first_name, $user_last_name, $user_password);

        $insert_in_table->execute();
        $insert_in_table->close();
        echo "user added";
            header('LOCATION: login.php');
    }
}
catch (mysqliException $exception){
    $_SESSION['messages'][] = 'Connection failed' . $exception->getMessage();
    header('LOCATION: register.php');
    exit();
}

//if($valid){
//    header('LOCATION: message.php');
//    exit();
//}










