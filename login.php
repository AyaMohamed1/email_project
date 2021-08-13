<?php

// if email is not empty, set a cookie of email with post function
if(!empty($_POST["v_userEmail"]))
    setcookie("v_userEmailCookie", $_POST["v_userEmail"], time() +(86400 * 30), "/");

// if password is not empty, set a cookie of password with post function
if(!empty($_POST["v_userPassword"]))
    setcookie("v_userPasswordCookie", $_POST["v_userPassword"], time()+ (86400 * 30), "/");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="formStyles">
    <?php
    $emailErr = $passwordErr = $email = $password = " ";
    $redic = true;

    // using POST
    if($_SERVER ["REQUEST_METHOD"] == "POST"){

        // if email is empty, request it and set redirect to false
        if(empty($_POST["v_userEmail"])){
            $emailErr = "E-Mail is requird";
            $redic = false;
        }

        // if password is empty, request it and set redirect to false
        if(empty($_POST["v_userPassword"])){
            $passwordErr = "Password is required";
            $redic = false;
        }

        // if true, then redirect it
        if($redic){
            header('LOCATION: connect_login.php');
            exit();
        }
    }

    ?>
    <span class="error"> </span>
    <br><br>
    <?php require_once "messages.php"; ?>
    <form method = "POST" >
        Email: <input type = "email" name = "v_userEmail" required>
        <span class="error">
            <?php echo $emailErr ?> </span> <br> <br>
        Password: <input type = "password" name = "v_userPassword" required>
        <span class="error">
            <?php echo $passwordErr ?> </span> <br> <br>
        <input type = "submit" value = "Login" required formaction ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);  ?>">

</div>
</form>
</body>
</html>
