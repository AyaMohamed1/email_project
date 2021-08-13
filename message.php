<?php

// if email is not empty, set a cookie of email with post function
if(!empty($_POST["receiver_email"]))
    setcookie("receiver_emailCookie", $_POST["receiver_email"], time() +(86400 * 30), "/");

// if password is not empty, set a cookie of password with post function
if(!empty($_POST["email_title"]))
    setcookie("email_titleCookie", $_POST["email_title"], time()+ (86400 * 30), "/");

if(!empty($_POST["email_message"]))
    setcookie("email_messageCookie", $_POST["email_message"], time()+ (86400 * 30), "/");
?>



<!DOCTYPE html>
<html>
<head>
    <title>Send Email</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="formStyles">
    <?php
    $emailErr = $messageErr = $titleErr = " ";
    $redic = true;

    // using POST
    if($_SERVER ["REQUEST_METHOD"] == "POST"){

        // if email is empty, request it and set redirect to false
        if(empty($_POST["receiver_email"])){
            $emailErr = "User Email is required";
            $redic = false;
        }

        if(empty($_POST["email_title"])){
            $titleErr = "Title is required";
            $redic = false;
        }

        if(empty($_POST["email_message"])){
            $messageErr = "Message is required";
            $redic = false;
        }

        // if true, then redirect it
        if($redic){
            header('LOCATION: connect_message.php');
            exit();
        }
    }

    ?>
    <span class="error"> </span>
    <br><br>
    <?php require_once "messages.php"; ?>
    <form method = "POST" >
        Receiver Email: <input type = "email" name = "receiver_email" required>
        <span class="error">
            <?php echo $emailErr ?> </span> <br> <br>
        Title: <input type = "text" name = "email_title" required>
        <span class="error">
            <?php echo $titleErr ?> </span> <br> <br>
        Message: <textarea id = "email_message" name="email_message" rows="8" cols="34" required> </textarea>
        <span class="error">
            <?php echo $messageErr ?> </span> <br> <br>
        <input type = "submit" value = "Send" required formaction ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);  ?>">

</div>
</form>
</body>
</html>
