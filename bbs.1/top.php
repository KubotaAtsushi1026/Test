<?php
    require_once 'login_filter.php';
    require_once 'models/User.php';
    require_once 'models/Post.php';
    session_start();
    $login_user = $_SESSION['login_user'];
    $flash_message = $_SESSION['flash_message'];
    $_SESSION['flash_message'] = null;
    
    $posts = Post::all();
    // var_dump($posts);
    
    include_once 'views/top_view.php';