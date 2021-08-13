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

    $sender_email_address = $_SESSION['user_email'];
    $receiver_email_address = $_COOKIE["receiver_emailCookie"];
    $email_title = $_COOKIE["email_titleCookie"];
    $email_message = $_COOKIE["email_messageCookie"];

    $check_user_email = "SELECT * FROM user WHERE Email_address= '" . $receiver_email_address . "'";
    $res = $conn->query($check_user_email);
    if ($res->num_rows > 0) {
        $insert_in_table = $conn->prepare('INSERT INTO email (Sender,Reciever, Title, Body)
                                VALUES (?,?,?,?)');
        $insert_in_table->bind_param("ssss", $sender_email_address ,$receiver_email_address, $email_title, $email_message);
        $insert_in_table->execute();
        $insert_in_table->close();
        echo "message sent!";
        //    header('LOCATION: profile.php');
    } else {
        echo "receiver not exist";
        $_SESSION["messages"][] = "Receiver email doesn't exist! Please check that email and try again." . "</br>";
        header('LOCATION: message.php');
        exit;
    }
}
catch (mysqliException $exception){
    echo "connection failed";
    $_SESSION['messages'][] = 'Connection failed' . $exception->getMessage();
    header('LOCATION: message.php');
    exit();
}









