<?php


// if name is not empty, set a cookie of name with post function
if(!empty($_POST["userFirstName"]))
    setcookie("userFirstNameCookie", $_POST["userFirstName"], time()+ (86400 * 30), "/");

if(!empty($_POST["userLastName"]))
    setcookie("userLastNameCookie", $_POST["userLastName"], time()+ (86400 * 30), "/");


// if email is not empty, set a cookie of email with post function
if(!empty($_POST["userEmail"]))
    setcookie("userEmailCookie", $_POST["userEmail"], time() +(86400 * 30), "/");

// if password is not empty, set a cookie of password with post function
if(!empty($_POST["userPassword"]))
    setcookie("userPasswordCookie", $_POST["userPassword"], time()+ (86400 * 30), "/");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="formStyles">
    <?php
    $LnameErr = $nameErr = $emailErr = $passwordErr = $phoneErr = $name = $email = $password = $phone = " ";
    $redic = true;

    // using POST
    if($_SERVER ["REQUEST_METHOD"] == "POST"){

        // if name is empty, request it and set redirect to false
        if(empty($_POST["userFirstName"])){
            $nameErr = "Name is required";
            $redic  = false;
        }

        // if name is not empty, if is not alphabet or underscore, then set redirect to false
        else{
            $regex = '/\w/';
            if(preg_match($regex, $_POST["userFirstName"])){
                $nameErr = "Name could have only alphabet & underscores";
            }
        }

        // if name is empty, request it and set redirect to false
        if(empty($_POST["userLastName"])){
            $nameErr = "Name is required";
            $redic  = false;
        }

        // if name is not empty, if is not alphabet or underscore, then set redirect to false
        else{
            $regex = '/\w/';
            if(preg_match($regex, $_POST["userLastName"])){
                $LnameErr = "Name could have only alphabet & underscores";
            }
        }

        $email = filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL);

        // if email is empty, request it and set redirect to false
        if(empty($_POST["userEmail"])){
            $emailErr = "E-Mail is requird";
            $redic = false;
        }

        // if email is not empty, if is not in an email form, then set redirect to false
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailErr =  "invalid E-Mail";
            $redic = false;
        }

        // if password is empty, request it and set redirect to false
        if(empty($_POST["userPassword"])){
            $passwordErr = "Password is required";
            $redic = false;
        }

        // if password is not empty, if is less than 8 characters, then set redirect to false
        else{
            $password = $_POST["userPassword"];
            if(strlen($password) < 8){
                $passwordErr = "password can't be less than 8 characters";
            }
        }

        // if true, then redirect it
        if($redic){
            header('LOCATION: connect.php');
            exit();
        }
    }

    ?>
    <span class="error"> </span>
    <br><br>
    <?php require_once "messages.php"; ?>
    <form method = "POST" >
        First Name: <input type="text" placeholder='First Name' name = "userFirstName" required>
        <span class="error">
            <?php echo $nameErr ?> </span> <br> <br>
        Last Name: <input type="text" placeholder='Last Name' name = "userLastName" required>
        <span class="error">
            <?php echo $LnameErr ?> </span> <br> <br>

        Email: <input type = "email" placeholder='Email' name = "userEmail" required>
        <span class="error">
            <?php echo $emailErr ?> </span> <br> <br>
        Password: <input type = "password" placeholder='Password' name = "userPassword" required>
        <span class="error">
            <?php echo $passwordErr ?> </span> <br> <br>
        <input type = "submit" value = "Register" formaction ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);  ?>">

</div>
</form>
</body>
</html>
