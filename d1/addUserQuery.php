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

if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password']) && isset($_POST['unit']) && isset($_POST['isAdmin']) && isset($_FILES["image"])) {
  $name = htmlclean($_POST['name']);
  $surname = htmlclean($_POST['surname']);
  $username = htmlclean($_POST['username']);
  $email = htmlclean($_POST['email']);
  $phone = htmlclean($_POST['phone']);
  $password = htmlclean($_POST['password']);
  $unit = htmlclean($_POST['unit']);
  $isAdmin = htmlclean($_POST['isAdmin']);
  $target_dir='./uploads/user/';
  $uploadResult = secureFileUpload($_FILES["image"], $target_dir);

  if ($uploadResult['status']) {
    $imageName = $uploadResult['filename'];
    $target_file = $target_dir . $imageName;
    AddUser($name, $surname, $username, $email, $phone, $password, $unit, $isAdmin, $imageName);
    } else {
     header("Location: addUser.php?message=" . $uploadResult['message']);
    exit;
    
    }


  echo '<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Profile</title>
      <link rel="stylesheet" href="style.css">
  </head>
  <body>

    <div class="profileContainer">
        <div class="profileBar">';
  echo "<img src='$target_file' alt='Avatar' class='avatar' style='width: 150px;'>
            <p><i><b>İsim Soyisim: </b></i> $name $surname</p>
            <p><i><b>Kullanıcı Adı: </b>$username</p>
            <p><i><b>Email: </b>$email</p>
            <p><i><b>Telefon Numarası: </b>$phone</p> 
            <p><i><b>Birimi: </b>$unit</p>
            <p><b>Admin mi? : $isAdmin</b></p>";
  echo '  </div>
        <button style="width: 200px;" id="homePageButton" onclick="goToHomePage()">Anasayfa</button>
    </div>

    <script src="script.js"></script>
    
</body>
</html>';
} else {
  header("Location: addUser.php?message=You must fill all the fields!");
}
