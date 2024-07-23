<?php 
  session_start();
  include "functions/functions.php";
  
  if (!isset($_SESSION['id']) && !isset($_SESSION['username']) ) {
    header("Location: login.php?message=You are not logged in!");
    exit();
  }
  $posts = GetPosts();
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Paylaşım Sayfası</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="blogContainer">

        <div class="header">
            <button style="width: 250px;" id="homePageButton" onclick="goToHomePage()">Anasayfa</button>
            <h1>Post Paylaşım Sayfası</h1>
        </div>
        <div class="post-container">
            <?php
          foreach ($posts as $post):?>
            <div class="post-card">
                <img src="./uploads/posts/<?php echo $post['imageName']; ?>" style="width: 200px;height: 100px;"
                    alt="Dummy Image">
                <h1><?php echo $post['title'] ?></h1>
                <p>
                    <?php echo $post['info'] ?>
                </p>
                <button class="btn">Daha Fazla </button>
            </div>
            <?php endforeach ?>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>