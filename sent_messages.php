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

$sender_email_address = $_SESSION['user_email'];

$sql = "SELECT * FROM email WHERE Sender = '".$sender_email_address."'";
$res = $con->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>

<h2>Sent Messages</h2>
<?php if($res->num_rows == 0){?>
<h3>You didn't send any Messages!</h3> <?php } ?>

<?php
if($res->num_rows > 0){
    echo "<table>";
        echo "<tr>";
            echo "<th>" ."Receiver"."</th>";
        echo "<th>" ."Title"."</th>";
        echo "<th>" ."Message"."</th>";
        echo "<th>" ."Time"."</th>";
        echo "</tr>";


    while($row = $res->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" .$row["Reciever"]."</td>";
        echo "<td>" .$row["Title"]."</td>";
        echo "<td>" .$row["Body"]."</td>";
        echo "<td>" .$row["Time"]."</td>";
        echo "</tr>";
    }
    echo "</table>";
 } ?>

</body>
</html>
