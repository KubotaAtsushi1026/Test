<?php
    require_once 'models/User.php';
    session_start();
    // var_dump($_POST);
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $user = User::login($email, $password);
    
    // var_dump($user);
    if($user !== false){
        // その見つけたユーザーをセッションに保存
        $_SESSION['login_user'] = $user;
        // flash_messageをセット
        $_SESSION['flash_message'] = 'ログインしました';
        // リダイレクト
        header('Location: top.php');
        exit;
    }else{
        $errors = array();
        $errors[] = 'そのようなユーザーは登録されていません';
        $_SESSION['errors'] = $errors;
        // リダイレクト
        header('Location: login.php');
        exit;
    }