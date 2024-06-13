<?php
        $servername="localhost";
        $username="MTA";
        $password1="mahfouz9402";
        $dbName="ethioNewsDB";
        $conn=new mysqli($servername,$username,$password1,$dbName);
        if($conn->connect_error){
            die("Connection Failed".$conn->connect_error);
        }

?>