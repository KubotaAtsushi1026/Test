<?php
    require_once 'models/Post.php';
    session_start();
    // var_dump($_POST);
    $id = $_POST['id'];
    Post::destroy($id);
    
    $_SESSION['flash_message'] = $id. '番目の投稿を削除しました';
    header('Location: top.php');
    exit;