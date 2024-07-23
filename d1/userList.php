<?php 
  session_start();
  include "functions/functions.php";
  
  if (!isset($_SESSION['id']) && !isset($_SESSION['username']) ) {
    header("Location: login.php?message=You are not logged in!");
    exit();
  }
  $fenerbahce = GetUsers();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üyeler</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div class="userList">
        <button style="width: 200px;" id="homePageButton" onclick="goToHomePage()">Anasayfa</button>
        <table>
            <thead>
                <tr>
                    <th>Profil Resmi</th>
                    <?php
          if($_SESSION['isAdmin']):?>
                    <th>ID</th>
                    <?php endif?>
                    <th>Adı Soyadı</th>
                    <th>Kullanıcı Adı</th>
                    <th>Email Adresi</th>
                    <th>Birimi</th>
                    <th>Telefonu</th>
                    <?php if( $_SESSION['isAdmin']):?>
                    <th>Admin Mi</th>
                    <th colspan="2">İşlemler</th>
                    <?php endif?>
                </tr>
            </thead>
            <tbody>
                <?php foreach($fenerbahce as $user):?>
                <tr>
                    <td><img src="./uploads/user/<?php echo $user['profilePhoto'];?>" alt="Avatar" class="avatar"
                            style="width: 40px;"></td>
                    <?php if($_SESSION['isAdmin']):?>
                    <td><?php echo $user['id'];?></td>
                    <?php endif?>
                    <td><?php echo $user['name'] . " " . $user['surname'];?></td>
                    <td><?php echo $user['nickname'];?></td>
                    <td><?php echo $user['email'];?></td>
                    <td><?php echo $user['groupName'];?></td>
                    <td><?php echo $user['phoneNumber'];?></td>
                    <?php if( $_SESSION['isAdmin']):?>
                    <td><?php $a = $user['isAdmin'] ? "Evet" : "Hayir"; echo $a; ?></td>
                    <td><a href='deleteUser.php?id=<?php echo $user["id"]?>'>Sil</a></td>
                    <?php endif?>
                </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
    <script src="script.js"></script>
</body>

</html>