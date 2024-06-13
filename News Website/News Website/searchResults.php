<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <!-- Include your CSS files here -->

   
</head>
<body>
    <?php
    require("php/header.php");
    ?>
    
    <style>
        .search-form {
            margin-top: 20px;
            text-align: center;
        }

        .search-form input[type="text"] {
            width: 300px;
            padding: 10px;
            border: solid;
            border-radius: 5px;
            font-size: 16px;
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px; /* Add margin between input and submit button */
        }

        .search-form input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            display: inline-block;
            vertical-align: middle;
            max-width: 100px;
        }

        /* Adjust the container width for responsive design */
        @media (max-width: 768px) {
            .container {
                max-width: 100%;
                padding: 0 20px;
            }

            .search-form input[type="text"] {
                width: 100%; /* Make the input field full width on smaller screens */
                margin-right: 0;
                margin-bottom: 10px; /* Add some space between input and submit button on smaller screens */
            }
        }
    </style>

    <section>
        <div class="container">
        <form class="search-form" action="searchResults.php" method="GET">
                    <input type="text" name="search" placeholder="Search news...">
                    <input type="submit" value="Search" name='sub' class='btn' style="display:inline;">
                </form><br><br>
            <h2>Search Results</h2><br>
            <?php
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            $searchInput=$_GET['search'];
            if(strlen($searchInput)>0){
                require("database/connectionMysqli.php");
                $result = $conn->query("SELECT * FROM NEWS WHERE title LIKE '%$searchInput%'");
    
                $footerMarginTop;
                if($result->num_rows==0){
                    $footerMarginTop="600px";
                }elseif($result->num_rows==1){
                    $footerMarginTop="400px";
                }else{
                    $footerMarginTop="200px";
                }
                if ($result->num_rows > 0) {
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
                } else {
                    echo "<p>No results found.</p>";
                }
            }else{
                $footerMarginTop="600px";
                echo "<p>No results found.</p>";     
            }
            
            ?>
        </div>
    </section>
    
    <footer style="margin-top:<?php echo $footerMarginTop?>">
        <div class="footer-container">
            <p>&copy; <?php echo date('Y'); ?> Ethio-News. All rights reserved.</p>
        </div>
    </footer>

    <!-- Include your JS files here -->
    <script src="path/to/your/script.js"></script>
</body>
</html>
