<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signup.css">
    <title>Ethio-News | Signup</title>
</head>
<body>
<style>
        .User_Registration_Form{
            border: 2px solid blueviolet; /* Add border style */
            padding: 20px; /* Optional: Add some padding for better appearance */
            width: 30%;
            margin-left: 100px;
        }
        .required{
            color: red;
            display: inline-block;
        }
    </style>
    <?php
        require("../database/connectionPDO.php");
        $nameWarning=$emailWarning=$passwordWarning=$confirmedPasswordWarning="*";
        $fullName=$_POST["fullname"];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $confirmedPassword=$_POST['confirm-password'];

        $namePattern="/[a-zA-Z ]/";
        $numberpattern="/[0-9]+/";
        $emailPattern="/^[a-zA-Z\.0-9 ]+[@][a-zA-Z. ]+[.][a-zA-z]{2,3}/";
       
        $nameCondition=preg_match($namePattern,$fullName)==1 && preg_match($numberpattern,$fullName)==0;
        $emailCondition=preg_match($emailPattern,$email)==1;
       
        if($nameCondition){
            $nameWarning="";
        }
        if( $emailCondition){
            $emailWarning="";
        }
        if(strlen($password)>0){
            $passwordWarning="";
        }
        if(strlen($confirmedPassword)>0){
            $confirmedPasswordWarning="";
        }

        $warnings=$nameWarning.$emailWarning.$passwordWarning.$confirmedPasswordWarning;
        
    ?>
    
    <div class="signup-container">
        <h1>Become a News Reporter</h1>
        <form class="signup-form" action="signup.php" method="POST">
            <p class="required">* required<p><br>
            <label for="fullname">Full Name</label>
            <?php echo "<p class=\"required\">".$nameWarning."</p>"?>
            <input type="text" id="fullname" name="fullname">

            <label for="email">Email</label>
            <?php echo "<p class=\"required\">".$emailWarning."</p>"?>
            <input type="email" id="email" name="email" >

            <label for="password">Password</label>
            <?php echo "<p class=\"required\">".$passwordWarning."</p>"?>
            <input type="password" id="password" name="password" >

            <label for="confirm-password">Confirm Password</label>
            <?php echo "<p class=\"required\">".$confirmedPasswordWarning."</p>"?>
            <input type="password" id="confirm-password" name="confirm-password">

            <div class="buttons-container">
                <input type="submit" name="signup" value="Sign Up" class="btn">
             </div>     
        </form>
        <a href="../homePage.php" style="color: white; text-decoration:none; "><button style="width:320px;" class='btn'>Go back to Home Page</button></a>

    </div>
</body>
</html>

<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if(strlen($warnings)==0) {
        $fullName = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirm-password'];
        if($password == $confirmedPassword) {
            try{
                $stmt=$conn->prepare("INSERT INTO NewsReporters (name,email,password,join_date) values (:n,:e,:p,:j)");
                $stmt->bindParam(":n",$fullName);
                $stmt->bindParam(":e",$email);
                $stmt->bindParam(":p",$password);
                $stmt->bindParam(":j", date("Y-m-d H:i:s"));
                if($stmt->execute()){
                    header("Location: ../homePage.php");
                }else{
                    echo "NOOO";
                }

            }catch(PDOException $e){
                echo "Error ".$e->getMessage();
            }


        }
    }
?>
    


