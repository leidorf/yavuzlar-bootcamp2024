<?php
session_start();
include "functions/functions.php";

if (!$_SESSION['isAdmin']) {
  header("Location: index.php?message=You are not authorized to view this page!");
  die();
}
if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
  header("Location: login.php?message=You are not logged in!");
  die();
}

if (isset($_FILES["image"]) && isset($_POST['title']) && isset($_POST['info']) ) {
  $title = htmlclean($_POST['title']);
  $info = htmlclean($_POST['info']);
  $target_dir='./uploads/posts/';
  $uploadResult = secureFileUpload($_FILES["image"], $target_dir);

  if ($uploadResult['status']) {
    $imageName = $uploadResult['filename'];
    $target_file = $target_dir . $imageName;
    AddPost($title, $info, $imageName);
    } else {
     header("Location: addPost.php?message=" . $uploadResult['message']);
    exit;
    
    }


  echo '<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Post</title>
      <link rel="stylesheet" href="style.css">
  </head>
  <body>

    <div class="profileContainer">
        <div class="profileBar">';
  echo "<img src='$target_file' alt='Avatar' class='avatar' style='width: 150px;'>
            <p><i><b>Başlık: </b></i> $title</p>
            <p><i><b>Açıklama: </b>$info</p>";
  echo '  </div>
        <button style="width: 200px;" id="homePageButton" onclick="goToHomePage()">Anasayfa</button>
    </div>

    <script src="script.js"></script>
    
</body>
</html>';
} else {
  header("Location: addPost.php?message=You must fill all the fields!");
}
