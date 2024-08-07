<?php
  session_start();
  if (!$_SESSION['isAdmin']) {
    header("Location: index.php?message=You are not authorized to view this page!");
    die();
  }
  if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
    header("Location: login.php?message=You are not logged in!");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kullanıcı Ekleme Formu</title>

  <link rel="stylesheet" href="style.css">

  <style>

  </style>

</head>
</head>

<body>
  <div class="container">
    <div class="addUserForm">
      <h2 style="margin-bottom: 20px;">Yeni Üye Ekleme Formu</h2>
      <form action="addUserQuery.php" method="POST" enctype="multipart/form-data">
        <input type="file" id="image" name="image" accept="image/*" required><br><br>
        <input type="text" id="name" name="name" placeholder="İsim" required><br><br>

        <input type="text" id="surname" name="surname" placeholder="Soyisim" required><br><br>

        <input type="text" id="username" name="username" placeholder="Kullanıcı Adı" required><br><br>

        <input type="email" id="email" name="email" placeholder="Email" required><br><br>

        <input type="tel" id="phone" name="phone" placeholder="Telefon No" required><br><br>

        <input type="password" id="password" name="password" placeholder="Şifre" required><br><br>
       
        <label for="unit">Birimi:</label>

        <select name="unit" id="unit" required>
          <option value="" selected disabled>Birimi Seçiniz</option>
          <option value="Yavuzlar">Yavuzlar</option>
          <option value="YıldızCTI">Yıldız CTI</option>
          <option value="CyberDET">Cyber DET</option>
          <option value="Zayotem">Zayotem</option>
          <option value="Cuberium">Cuberium</option>
        </select><br><br>
        <div class="admin-options">
          <label>Admin mi? </label>
          <label for="admin-yes">
            <input type="radio" id="admin-yes" name="isAdmin" value="yes" required> Evet
          </label>
          <label for="admin-no">
            <input type="radio" id="admin-no" name="isAdmin" value="no" required> Hayır
          </label>
        </div>

        <button type="submit">Kullanıcı Ekle</button>
        <button style="margin-top: 5px;" id="homePageButton" type="button" onclick="goToHomePage()">Anasayfa</button>
      </form>

    </div>

  </div>
  <script src="script.js"></script>
</body>

</html>
