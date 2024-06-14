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
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

        <title>Ethio-News | Home</title>
    </head>
    <body>
        <?php
    require("php/header.php");
        ?>
        <!-- <style>
    .search-form input[type="text"] {
        display: inline-block;
        width: 70%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
    }

    .search-form input[type="submit"] {
        display: inline-block;
        width: 25%;
        background-color: #333;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        margin-left: 10px;
        cursor: pointer;
    }
</style> -->

        <section class="hero-section">
            <div class="hero-content">
                <h1 class="welcome-heading">Welcome to Ethio-News</h1>
                <p class="welcome-text">Your trusted source for Ethiopian news and updates</p>
                <form class="search-form" action="searchResults.php" method="GET">
                    <input type="text" name="search" placeholder="Search news...">
                    <input type="submit" value="Search" name='sub' class='btn' style="display:inline;">
                </form><br><br>
                <a href="#" class="btn">Explore Now</a>

            </div>
        </section>
        <!-- <style>
        * {box-sizing:border-box}

            /* Slideshow container */
            .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
            }

            /* Hide the images by default */
            .mySlides {
            display: none;
            }

            /* Next & previous buttons */
            .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -22px;
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            }

            /* Position the "next button" to the right */
            .next {
            right: 0;
            border-radius: 3px 0 0 3px;
            }

            /* On hover, add a black background color with a little bit see-through */
            .prev:hover, .next:hover {
            background-color: rgba(0,0,0,0.8);
            }

            /* Caption text */
            .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
            }

            /* Number text (1/3 etc) */
            .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
            }

            /* The dots/bullets/indicators */
            .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
            }

            .active, .dot:hover {
            background-color: #717171;
            }

            /* Fading animation */
            .fade {
            animation-name: fade;
            animation-duration: 1.5s;
            }

            @keyframes fade {
            from {opacity: .4}
            to {opacity: 1}
            }
        
        </style> -->
        <!-- Slideshow container -->
        <div class="slideshow-container">

        <!-- Full-width images with number and caption text -->
        <div class="mySlides fade">
            <div class="numbertext">1 / 3</div>
            <img src="images/image1.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
            <div class="numbertext">2 / 3</div>
            <img src="images/image2.jpg"" style="width:100%">
        </div>

        <div class="mySlides fade">
            <div class="numbertext">3 / 3</div>
            <img src="images/image3.jpg"" style="width:100%">
        </div>

        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>

        <!-- The dots/circles -->
        <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        </div><br><br>
    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
        showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
        showSlides(slideIndex = n);
        }

        function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
        }
    </script>
    <!-- <style>
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
    
    </style> -->
    <section class="latest-news-section">
        <div class="container">
            <h2>Latest News</h2>
            <div class="news-list">
            <?php
            ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
               
                $result=$conn->query("SELECT * FROM NEWS");
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
        <footer>
            <div class="footer-container">
                <p>&copy <?php echo date('Y')?> Ethio-News. All rights reserved.</p>
            </div>
        </footer>
    </body>
    </html>

