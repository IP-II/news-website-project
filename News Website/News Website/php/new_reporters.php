<?php
session_start();

if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header("Location: ../homePage.php");
    exit();
}
if(isset($_SESSION['id'])){
     
    $titleWarning=$descriptionWarning=$contentWarning=$dateWarning=$categoryWarning=$photoWarning="*";
    $title=$_POST["title"];
    $description=$_POST['description'];
    $content=$_POST['newsContent'];
    $date=$_POST['date'];
    $category=$_POST['category'];

    $namePattern="/[a-zA-Z ]/";
    $numberpattern="/[0-9]+/";
   
    $titleCondition=preg_match($namePattern,$title)==1 && preg_match($numberpattern,$title)==0;
    $descriptionCondition=preg_match($namePattern,$description)==1 && preg_match($numberpattern,$description)==0;

    if($titleCondition){
        $titleWarning="";
    }
    if( $descriptionCondition){
        $descriptionWarning="";
    }
    if(strlen($content)>0){
        $contentWarning="";
    }
    if(strlen($date)>0){
        $dateWarning="";
    }
    if(strlen($category)>0){
        $categoryWarning="";
    }
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $warnings=$titleWarning.$descriptionWarning.$dateWarning.$categoryWarning;
    if(!empty($_FILES['photo']['name']) && strlen($warnings)==0){
        $photoName=$_FILES['photo']['name'];
        $photoSize=$_FILES['photo']['size'];
        $tempName=$_FILES['photo']['tmp_name'];
        $photoType=$_FILES['photo']['type'];
        $targetDirectory='../uplodedImages/';
        $targetLocation=$targetDirectory.basename($photoName);
        if($photoType =='image/png'|| $photoType =='image/jpeg'|| $photoType =='image/gif'){
            if($photoSize<3000000){    
               if(move_uploaded_file($tempName,$targetLocation)){
                $photoWarning="";
               }
            }
        }    

    }
    $warnings=$titleWarning.$descriptionWarning.$dateWarning.$categoryWarning.$photoWarning;
   ?> 
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='../css/newsPage.css'>
        <title>Ethio-News | News Page</title>
    </head>
    <body>
        <style>
        .required{
            color: red;
            display: inline;
        }
       
    
        </style>
        
        <header>
            <nav>
                <ul>
                    <li><a href='../homePage.php'>Home</a></li>
                    <li><form method='POST' action='NewsReporters.php' style='display:inline;'><input type='submit' name='logout' value='Logout' class='btn'></form></li>
                    <li><a href='myProfile.php'>My Profile</a></li>
                </ul>
            </nav>
        </header>
    
        <div class='content'>
            <h1>News Page</h1>
            <table class='news-table'>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
                    <?php
                    // Replace this code with your database query logic
                    require('../database/connectionMysqli.php');
                    $result=$conn->query("SELECT * FROM NEWS where reporter_id=".$_SESSION['id']."");
                    
                    if($result->num_rows > 0){
                        while($news = $result->fetch_assoc()){
                            echo '<tr>';
                            echo '<td>' . $news['title'] . '</td>';
                            echo '<td>' . $news['description'] . '</td>';
                            echo '<td>' . $news['publish_date'] . '</td>';
                            echo '<td>' . $news['category'] . '</td>';
                            echo '<td class="actions">';
                            echo '<a href="editNews.php?id=' . $news['news_id'] . '" style="text-decoration:underline; color:purple;">Edit</a>';
                            echo '<a href="deleteNews.php?id=' . $news['news_id'] . '" style="text-decoration:underline; color:red;">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    }
                         
                    ?>
            </table>
    
            <div class='add-news-form'>
                <h2>Add News Article</h2>
                <form action='NewsReporters.php' method='POST' enctype="multipart/form-data">
                    <label for='title'>Title</label>
                    <input type='text' id='title' name='title' required>
    
                    <label for='description'>Description</label>
                    <input type='text' id='description' name='description' required>
    
                    <label for='newsContent'>News Content</label>
                    <textarea name='newsContent' required rows=10 ></textarea><br>
    
                    <label for='photo'>News Photo</label>
                    <input type='file' id='photo' name='photo' required><br>

                    <label for='date'>Date</label>
                    <input type='date' id='date' name='date' required>
    
                    <label for='category'>Category</label>
                    <div class='custom-select'>
                        <select id='category' name='category' required>
                                <option value='politics'>Politics</option>
                                <option value='sports'>Sports</option>
                                <option value='entertainment'>Entertainment</option>
                                <option value='technology'>Technology</option>
                                <option value='business'>Business</option>
                        </select>
                    </div>
                    <br><br>
                    <input type='submit' value='Add News'>
                </form>
            </div>
        </div>
    </body>
    </html>

    <?php
}else{
    header('Location: login.php');
}
?>
<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if(strlen($warnings)==0 && $_SERVER['REQUEST_METHOD']=='POST') {
            try{
                require('../database/connectionPDO.php');
                $stmt=$conn->prepare("INSERT INTO News (title,description,photoName,content,reporter_id,publish_date,category) values (:t,:d,:ph,:co,:r,:p,:c)");
                $stmt->bindParam(":t",$title);
                $stmt->bindParam(":d",$description);
                $stmt->bindParam(":ph", $photoName);
                $stmt->bindParam(":co",$content);
                $stmt->bindParam(":r", $_SESSION['id']);
                $stmt->bindParam(":p", $date);
                $stmt->bindParam(":c", $category);
                if($stmt->execute()){
                    
                   header("Location: NewsReporters.php");
                }else{
                    echo "NOOO";
                }

            }catch(PDOException $e){
                echo "Error ".$e->getMessage();
            }   
    }
?>
