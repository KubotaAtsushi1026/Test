<?php
    require_once 'login_filter.php';
    require_once 'models/User.php';
    require_once 'models/Post.php';
    session_start();
    // var_dump($_GET);
    $id = $_GET['id'];
    // print $id;
    $post = Post::find($id);
    $comments = $post->comments();
    // var_dump($comments);
    
    // var_dump($post);
    $login_user = $_SESSION['login_user'];
    $flash_message = $_SESSION['flash_message'];
    $_SESSION['flash_message'] = null;
    // var_dump($login_user);
    // var_dump($user);
    include_once 'views/show_view.php';