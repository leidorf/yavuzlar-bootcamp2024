<?php
session_start();

if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
  header("Location: login.php?message=You are not logged in!");
} else {
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anasayfa</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="navbarContainer">
        <form action="logout.php" method="post">
            <button class="logout" id="logoutButton">Çıkış Yap</button>
        </form>

        <div class="header">
            <h1>Yavuzlar Takımı</h1>
        </div>
        <div class="navbar">
            <a href="userList.php">
                <div class="navbarButton">
                    Üyeler
                </div>
            </a>
            <?php if ($_SESSION['isAdmin']):?>
            <a href="addUser.php">
                <div class="navbarButton">
                    Üye Ekle
                </div>
            </a>
            <?php endif?>
            <a href="blogPost.php">
                <div class="navbarButton">
                    İçerikler
                </div>
            </a> <a href="addPost.php">
                <div class="navbarButton">
                    İçerik Paylaş
                </div>
            </a>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>

<?php } ?>