<?php

    function Login($nickname,$passwd){

        include "db.php";

        $query = "SELECT *,COUNT(*) as count FROM users WHERE nickname = :nickname AND passwd = :passwd";
    
        $statement = $pdo->prepare($query);

        $statement->execute(['nickname' => $nickname, 'passwd' => $passwd]);

        $result = $statement->fetch();

        return $result;
    }


    function GetUsers(){
        include "db.php";

        $query = "SELECT * FROM users";

        $statement = $pdo->prepare($query);

        $statement->execute();

        $result = $statement->fetchAll();

        return $result;
    }

    function AddUser($name,$surname,$username,$email,$phone,$password,$unit,$isAdmin,$imageName){

        include "db.php";

        $query = "INSERT INTO users(name,surname,nickname,email,passwd,profilePhoto,isAdmin,groupName,phoneNumber) VALUES('$name','$surname','$username','$email','$password','$imageName','$isAdmin','$unit','$phone')";

        $statement = $pdo->prepare($query);

        $statement->execute();
    }

    function DeleteUser($id){
        include "db.php";

        $query = "DELETE FROM users WHERE id = $id";

        $statement = $pdo->prepare($query);

        $statement->execute();
    }

    function htmlclean($text){
        $text = preg_replace("'<script[^>]*>.*?</script>'si", '', $text );
        $text = preg_replace('/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is', '\2 (\1)', $text );
        $text = preg_replace('/<!--.+?-->/', '', $text ); 
        $text = preg_replace('/{.+?}/', '', $text ); 
        $text = preg_replace('/&nbsp;/', ' ', $text );
        $text = preg_replace('/&amp;/', ' ', $text ); 
        $text = preg_replace('/&quot;/', ' ', $text );
        $text = strip_tags($text);
        $text = htmlspecialchars($text); 

        return $text;
    }

    function secureFileUpload($file, $target_dir, $allowed_types = ['jpg', 'jpeg', 'png', 'gif']){
        if($file['error'] !== UPLOAD_ERR_OK){
            return ['status' => false, 'message' => "File Upload Error!"];
        }

        $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if(!in_array($file_ext, $allowed_types)){
            return ['status' => false, 'message' => "Invalid file type!"];
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        $allowed_types = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif'
        ];

        if(!array_key_exists($mime, $allowed_types)){
            return ['status' => false, 'message' => "Invalid MIME Type!"];
        }

        $magic_bytes = [
            'jpg' => "\xFF\xD8\xFF",
            'jpeg' => "\xFF\xD8\xFF",
            'png' => "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A",
            'gif' => "GIF"
        ];

        $fh = fopen($file['tmp_name'], 'rb');
        $bytes=fread($fh,8);
        fclose($fh);

        if(strpos($bytes, $magic_bytes[$file_ext]) !== 0){
            return ['status' => false, 'message' => "File failed magic byte check!"];
        }

        $random_number = rand(1,1000);
        $new_filename = $random_number . '_' . basename($file['name']);
        $target_file = $target_dir . $new_filename;

        if(!move_uploaded_file($file['tmp_name'], $target_file)){
            return ['status' => false, 'message' => "Error moving the uploaded file!"];
        }

        return ['status' => true, 'filename' => $new_filename];
    }

    function GetPosts(){
        include "db.php";

        $query = "SELECT * FROM posts";

        $statement = $pdo->prepare($query);

        $statement->execute();

        $result = $statement->fetchAll();

        return $result;    
    }

    function AddPost($title, $info, $imageName){
        include "db.php";

        $query = "INSERT INTO posts(title,info,imageName) VALUES('$title','$info','$imageName')";

        $statement = $pdo->prepare($query);

        $statement->execute();
    }



?>