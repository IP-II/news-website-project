<?php
require("database/connectionMysqli.php");
session_start();
?>
   <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/homepage.css">
        <title>Ethio-News | Home</title>
    </head>
    <body>
        <?php
    require("php/header.php");
        ?>

        
    <style>
    .latest-news-section .container {
        max-width: 960px; /* Adjust the maximum width as needed */
        margin: 0 auto;
      }
      
      .latest-news-section h2 {
        text-align: center;
      }
      
      .latest-news-section .news-list {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
      }
      
      .latest-news-section .news-article {
        width: 200px;
        margin: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
      }
      
      .latest-news-section .news-article .image img {
        width: 100%;
        height: auto;
        border-radius: 5px;
      }
      
      .latest-news-section .news-article h3 {
        margin-top: 10px;
        font-size: 18px;
      }
      
      .latest-news-section .news-article p {
        margin-top: 5px;
        font-size: 14px;
      }
    
    </style>
    <section class="latest-news-section">
        <div class="container">
            <h2>Politics News</h2>
            <div class="news-list">
            <?php
            ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
               
                $result=$conn->query("SELECT * FROM NEWS where category='politics'");
                $footerMarginTop;
                if($result->num_rows==0){
                    $footerMarginTop="600px";
                }elseif($result->num_rows==1){
                    $footerMarginTop="400px";
                }else{
                    $footerMarginTop="200px";
                }
                if($result->num_rows>0){
                    while($row=$result->fetch_assoc()){
                        echo "<div class='news-article'>
                        <div class='image'>
                            <img src='uplodedImages/".$row['photoName']."' alt='News Image' style='width:180px; height:110px'>
                        </div>
                        <div class='content'>
                            <h3><a href='php/full_news.php?id=" . $row['news_id'] . "'>" . $row['title'] . "</a></h3>
                            <p>".$row['description']."</p>
                            <!-- Add other content elements here -->
                        </div>
                    </div>";
                    }
                    
                }else{
                    echo "no news";
                }
                ?>
            </div>
        </div>  
    </section> 
        <footer style="margin-top:<?php echo $footerMarginTop?>">
                <p>&copy <?php echo date('Y')?> Ethio-News. All rights reserved.</p>
            </div>
        </footer>
    </body>
    </html>

