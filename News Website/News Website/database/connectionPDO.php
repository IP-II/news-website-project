<?php
try{
     $servername="localhost";
     $username="MTA";
     $password="mahfouz9402";
     $dbName="ethioNewsDB";
     $conn=new PDO("mysql:host=$servername;dbname=$dbName",$username,$password);
     $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Error ".$e->getMessage();
    }
?>