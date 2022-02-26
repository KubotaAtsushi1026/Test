<?php
    require_once 'models/User.php';
    session_start();
    $login_user = $_SESSION['login_user'];
    if($login_user === null){
        $errors = array();
        $errors[] = '不正アクセスです。ログインしてください';
        $_SESSION['errors'] = $errors;
        header('Location: login.php');
        exit;
    }