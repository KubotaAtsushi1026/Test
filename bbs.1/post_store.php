<?php
    require_once 'models/Post.php';
    require_once 'models/User.php';
    session_start();
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_FILES['image']['name'];
    
    $login_user = $_SESSION['login_user'];
    
    if($_FILES['image']['size'] === 0){
        $image = '';
    }
    
    $post = new Post($login_user->id, $title, $content, $image);
    // var_dump($post);
    $errors = $post->validate();
    // var_dump($errors);
    if(count($errors) === 0){
        
        $image = mt_rand(100, 10000) . $image;
        $post->image = $image;
        
        $flash_message = $post->save();
        // 画像のフルパスを設定
        $file = 'upload/' . $image;
    
        // uploadディレクトリにファイル保存
        move_uploaded_file($_FILES['image']['tmp_name'], $file);
        $_SESSION['flash_message'] = $flash_message;
        header('Location: top.php');
        exit;
        
    }else{
        $_SESSION['errors'] = $errors;
        header('Location: post_create.php');
        exit;
    }