<?php
    // var_dump($_POST);
    require_once 'models/User.php';
    require_once 'models/Comment.php';
    session_start();
    $post_id = $_POST['post_id'];
    $content = $_POST['content'];
    $login_user = $_SESSION['login_user'];
    
    // var_dump($login_user);
    
    $comment = new Comment($login_user->id, $post_id, $content);
    
    $errors = $comment->validate();
    // var_dump($errors);
    if(count($errors) === 0){
        $flash_message = $comment->save();
        $_SESSION['flash_message'] = $flash_message;
        header('Location: show.php?id=' . $post_id);
        exit;
        
    }else{
        $_SESSION['errors'] = $errors;
        // header('Location: show.php?id=' . $post_id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    // var_dump($comment);
    