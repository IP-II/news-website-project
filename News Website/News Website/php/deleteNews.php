<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id=$_GET['id'];
require('../database/connectionMysqli.php');
$result=$conn->query("select photoName from news where news_id=$id");
if($result->num_rows>0){
    $row=$result->fetch_assoc();
    if(unlink('../uplodedImages/'.$row['photoName'])){
        $stmt=$conn->prepare("delete from news where news_id=?");
        $stmt->bind_param("i",$id);
        if($stmt->execute() && $stmt->affected_rows>0){
            header("Location: NewsReporters.php");
        }
    }
    
}


?>
