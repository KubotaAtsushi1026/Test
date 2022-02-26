<?php 
    require_once 'login_filter.php';
    require_once 'models/User.php';
    require_once 'models/Post.php';
    session_start(); 
    $id = $_GET['id'];
    $post = Post::find($id);
    // var_dump($post);
    $login_user = $_SESSION['login_user'];
    $flash_message = $_SESSION['flash_message'];
    $_SESSION['flash_message'] = null;
    // var_dump($login_user);
    include_once 'views/show_view.php';