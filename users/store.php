<?php
    require_once 'User.php';
    session_start();
    // print 'OK';
    // var_dump($_POST);
    $name = $_POST['name'];
    $age = $_POST['age'];
    // print $name;
    // print $age;
    $new_user = new User($name, $age);
    // var_dump($new_user);
    $errors = $new_user->varidate();
    // var_dump($errors);
    // 名前も年齢も両方正しく入力されていれば
    if(count($errors) === 0){
        
        $users = $_SESSION['users'];
        if($users === null){
            $users = array();
        }
        $users[] = $new_user;
        $_SESSION['users'] = $users;
        // $_SESSION['new_user'] = $new_user;
        $_SESSION['flash_message'] = $name . 'さんが新規登録されました';
        
        // リダイレクト
        header('Location: index.php');
        exit;
    }else{
        $_SESSION['errors'] = $errors;
        header('Location: create.php');
        exit;
    }
    