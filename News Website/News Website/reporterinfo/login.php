<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Ethio-News | Login</title>
</head>
<body>
    
    <div class="login-container">
        <h1>Login</h1>
        <form class="login-form" action="login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email">

            <label for="password">Password</label>
            <input type="password" id="password" name="password">

            <input type="submit" value="Login" class="btn">
        </form>
        <a href="../homePage.php" style="color: white; text-decoration:none; "><button style="width:320px;" class='btn'>Go back to Home Page</button></a>
    </div>
</body>
</html>
<?php

    if($_SERVER["REQUEST_METHOD"]=="POST"){
       
        $email=$_POST['email'];
        $password=$_POST['password'];

        require('../database/connectionMysqli.php');
        $result=$conn->query("SELECT * FROM NEWSREPORTERS where email='$email' and password='$password'");
        if($result->num_rows>0){
            $row=$result->fetch_assoc();
            session_start();
            $_SESSION["login_time_stamp"] = time();
            $_SESSION['id']=$row['reporter_id'];
            header("Location: NewsReporters.php");
        }
            
    }
   


?>
