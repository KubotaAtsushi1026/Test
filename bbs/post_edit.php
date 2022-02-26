<?php
    require_once 'login_filter.php';
    require_once 'models/Post.php';
    session_start();
    
    $id =$_GET['id'];
    // var_dump($_POST);
    $post = Post::finf($id);
    
    $errors = $_SESSION['errors'];
    $_SESSION['errors'] = null;

    
    include_once 'views/post_edit_view.php';