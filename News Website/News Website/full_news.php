<!DOCTYPE html>
<html>
<head>
    <title>Full News</title>
    <link rel="stylesheet" type="text/css" href="../css/full_news.css">
</head>
<body>
    <header>
            <div class="header-container">
                <h1 class="logo">Ethio-News</h1>
                <nav>
                    <ul>
                        <li><a href="../homePage.php">Home</a></li>
                        <li><a href="../politicsNews.php">Politics</a></li>
                        <li><a href="../sportsNews.php">Sports</a></li>
                        <li><a href="../entertainmentNews.php">Entertainment</a></li>
                        <li><a href="../techNews.php">Technology</a></li>
                        <li><a href="../businessNews.php">Business</a></li>
                    </ul>
                </nav>
                <div class="header-links">
                    <?php
                    session_start();
                    if(isset($_SESSION['id'])){
                        echo '<a href="../php/NewsReporters.php">Manage News</a>';
                    }else{
                        echo '
                        <a href="../php/signup.php">Become a News Reporter</a>
                        <a href="../php/login.php">Login</a>
                        ';
                    }
                    
                    ?>
                    
                </div>
            </div>
        </header>

    <div class="container">
        <?php
        if (isset($_GET['id'])) {
            $newsId = $_GET['id'];

             require('../database/connectionMysqli.php');
            $result=$conn->query("SELECT * FROM NEWS WHERE news_id=$newsId");
            if($result->num_rows>0){
                $row=$result->fetch_assoc();
                echo "<div class='news-article'>";
                echo "<div class='image-container' style='text-align: center;'>";
                echo "<img src='../uplodedImages/".$row['photoName']."' alt='News Image' style='width: 400px; height: 350px;'>";
                echo "</div>";
                echo "<h3>".$row['title']."</h3>";
                echo "<p>".$row['content']."</p>";
                echo "</div>";

                // Add other content elements here
                echo "</div>";
            }
          
        } else {
            echo "No news by this ID.";
        }
        ?>
    </div>
</body>
</html>
