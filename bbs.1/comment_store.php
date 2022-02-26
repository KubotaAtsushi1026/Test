<?php
    require_once 'models/User.php';
    require_once 'models/Comment.php';
    session_start();
    // var_dump($_POST);
    $post_id = $_POST['post_id'];
    $content = $_POST['content'];
    $login_user = $_SESSION['login_user'];
    
    // var_dump($login_user);
    $comment = new Comment($login_user->id, $post_id, $content);
    // var_dump($comment);
    $flash_message = $comment->save();
    $_SESSION['flash_message'] = $flash_message;
    
    header('Location: show.php?id=' . $post_id);
    exit;