<?php
    require_once 'models/User.php';
    session_start();
    // var_dump($_POST);
    // 入力された値を取得
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // データベースを見に行ってそんなユーザーいるのかチェック
    $user = User::login($email, $password);
    
    // var_dump($user);
    if($user !== false){
        $_SESSION['login_user'] = $user;
        $_SESSION['flash_message'] = 'ログインしました';
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
    