<?php
session_start();
    
if(isset($_SESSION['id'])){
    require('../database/connectionPDO.php');
    
        // Retrieve the news article from the database
        $stmt = $conn->prepare("SELECT * FROM NewsReporters WHERE reporter_id = :reporter_id");
        $stmt->bindParam(":reporter_id", $_SESSION['id']);
        $stmt->execute();
        $reporter = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (count($reporter)>0) {
            $name = $reporter['name'];
            $email = $reporter['email'];
            $password = $reporter['password'];
        } else {
           header('Location: NewsReporters.php');
        }
}else {
    header('Location: NewsReporters.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/editnews.css">
    <title>Ethio-News | Edit Profile</title>
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
        .form-group input {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
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
        <h2>Edit Profile</h2>
        <form action="myProfile.php" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required value="<?php echo $password; ?>">
            </div>

            <div class="form-group">
                <input type="submit" value="Update Profile">
            </div>
        </form>
    </div>
</body>
</html>
<?php
// Update news article
ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = $_POST['name'];
    $newEmail = $_POST['email'];
    $newPassword = $_POST['password'];
    // Update the news article in the database
    $stmt = $conn->prepare("UPDATE NewsReporters SET name = :name, email = :email, password = :password WHERE reporter_id = :id");
    $stmt->bindParam(":name", $newName);
    $stmt->bindParam(":email", $newEmail);
    $stmt->bindParam(":password", $newPassword);
    $stmt->bindParam(":id", $_SESSION['id']);
    if($stmt->execute()){
         header('Location: NewsReporters.php');
    }  
}



?>
