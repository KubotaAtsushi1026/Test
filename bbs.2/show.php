<?php
    require_once 'login_filter.php';
    require_once 'models/User.php';
    require_once 'models/Post.php';
    require_once 'models/Favorite.php';
    session_start();
    // var_dump($_GET);
    $id = $_GET['id'];
    // print $id;
    $post = Post::find($id);
    $comments = $post->comments();
    // var_dump($comments);
    
    $login_user = $_SESSION['login_user'];
    $flash_message = $_SESSION['flash_message'];
    $_SESSION['flash_message'] = null;
    
    $errors = $_SESSION['errors'];
    $_SESSION['errors'] = null;
    $flag = Favorite::find($login_user->id, $post->id);
    // var_dump($flag);
    $favorite_users = $post->favorites();
    // var_dump($favorite_users);
    // var_dump($login_user);
    include_once 'views/show_view.php';