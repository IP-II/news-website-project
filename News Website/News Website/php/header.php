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
session_start();
if(isset($_SESSION['id'])){
    ?>
    <header>
            <div class="header-container">
            <a href="homePage.php" style="color:white;"><h1 class="logo">Ethio-News</h1></a>
                <nav>
                    <ul>
                        <li><a href="homePage.php">Home</a></li>
                        <li><a href="politicsNews.php">Politics</a></li>
                        <li><a href="sportsNews.php">Sports</a></li>
                        <li><a href="entertainmentNews.php">Entertainment</a></li>
                        <li><a href="techNews.php">Technology</a></li>
                        <li><a href="businessNews.php">Business</a></li>
                    </ul>
                </nav>
                <div class="header-links">
                    <a href="php/NewsReporters.php">Manage News</a>
                </div>
            </div>
        </header>

<?php
}else{
    ?>
        <header>
            <div class="header-container">
            <a href="homePage.php" style="color:white;"><h1 class="logo">Ethio-News</h1></a>
                <nav>
                    <ul>
                        <li><a href="homePage.php">Home</a></li>
                        <li><a href="politicsNews.php">Politics</a></li>
                        <li><a href="sportsNews.php">Sports</a></li>
                        <li><a href="entertainmentNews.php">Entertainment</a></li>
                        <li><a href="techNews.php">Technology</a></li>
                        <li><a href="businessNews.php">Business</a></li>
                    </ul>
                </nav>
                <div class="header-links">
                    <a href="php/signup.php">Become a News Reporter</a>
                    <a href="php/login.php">Login</a>
                </div>
            </div>
        </header>
        <?php
}
?>
    </body>
