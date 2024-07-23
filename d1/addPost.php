<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İçerik Ekleme Formu</title>
    <link rel="stylesheet" href="style.css">
</head>
</head>

<body>
    <div class="container">
        <div class="addUserForm">
            <h2 style="margin-bottom: 20px;">Yeni Post</h2>
            <form action="addPostQuery.php" method="POST" enctype="multipart/form-data">
                <input type="file" id="image" name="image" accept="image/*" required><br><br>
                <input type="text" id="title" name="title" placeholder="Başlık" required><br><br>

                <textarea type="text" id="info" name="info" rows="6" placeholder="Yazı İçeriği"
                    required></textarea><br><br>

                <button type="submit">Post Paylaş</button>
                <button style="margin-top: 5px;" id="homePageButton" onclick="goToHomePage()">Anasayfa</button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>