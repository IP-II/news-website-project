<?php
session_start();
ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
if (!isset($_SESSION['id'])) {
    header('Location: ../homePage.php');
}

require('../database/connectionPDO.php');


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM News WHERE news_id = :id AND reporter_id = :reporter_id");
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":reporter_id", $_SESSION['id']);
    $stmt->execute();
    $newsArticle = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($newsArticle) {
        $title = $newsArticle['title'];
        $description = $newsArticle['description'];
        $content = $newsArticle['content'];
        $date = $newsArticle['publish_date'];
        $category = $newsArticle['category'];
    } else {
        header('Location: ../NewsReporters.php');
        exit();
    }
} else {
    header('Location: ../NewsReporters.php');
    exit();
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
     
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
               $photoWarning="";
            }
        }    

    }
    $warnings=$titleWarning.$descriptionWarning.$dateWarning.$categoryWarning.$photoWarning;
    if ( strlen($warnings)==0) {
        require('../database/connectionMysqli.php');
        $id=$_GET['id'];
        $result=$conn->query("select photoName from news where news_id=$id");
        if($result->num_rows>0){
            $row=$result->fetch_assoc();
            if(unlink('../uplodedImages/'.$row['photoName'])){
                if(move_uploaded_file($tempName,$targetLocation)){
                    require('../database/connectionPDO.php');
                    $stmt = $conn->prepare("UPDATE News SET title = :title, description = :description,photoName=:photoName, content = :content, publish_date = :publish_date, category = :category WHERE news_id = :id");
                    $stmt->bindParam(":title", $title);
                    $stmt->bindParam(":description", $description);
                    $stmt->bindParam(":photoName", $photoName);
                    $stmt->bindParam(":content", $content);
                    $stmt->bindParam(":publish_date", $date);
                    $stmt->bindParam(":category", $category);
                    $stmt->bindParam(":id", $id);
                    if($stmt->execute()){
                        // Redirect to the news page after updating
                        header('Location: NewsReporters.php');
                        exit();
                    }
                }
                
    
               
            }
            
        }
        // Update the news article in the database
        
    }
}
    // Update news article

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/editnews.css">
    <title>Ethio-News | Edit News</title>
    <style>
        /* Add your custom styles here */
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .form-group select {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .form-group textarea {
            resize: vertical;
            height: 150px;
        }
        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="../homePage.php">Home</a></li>
                <li>
                    <form method="POST" action="NewsReporters.php" style="display:inline;" class="btn">
                        <input type="submit" name="logout" value="Logout" class="btn">
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h2>Edit News Article</h2>
        <form action="editNews.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="<?php echo $title; ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" value="<?php echo $description; ?>" required>
            </div>

            <div class="form-group">
                <label for="newsContent">News Content</label>
                <textarea name="newsContent" required><?php echo $content; ?></textarea>
            </div><br>

            <label for='photo'>News Photo</label>
            <input type='file' id='photo' name='photo' required><br>

            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" value="<?php echo $date; ?>" required>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="Politics" <?php if ($category === 'Politics') echo 'selected'; ?>>Politics</option>
                    <option value="Sports" <?php if ($category === 'Sports') echo 'selected'; ?>>Sports</option>
                    <option value="Entertainment" <?php if ($category === 'Entertainment') echo 'selected'; ?>>Entertainment</option>
                    <option value="Technology" <?php if ($category === 'Technology') echo 'selected'; ?>>Technology</option>
                    <option value="Business" <?php if ($category === 'Business') echo 'selected'; ?>>Business</option>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" value="Update News">
            </div>
        </form>
    </div>
</body>
</html>
