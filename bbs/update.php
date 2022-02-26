<?php
        // 外部ファイル読み込み
    require_once 'models/User.php';
    // セッション開始(すべてのファイルが使える情報の共有箱)
    session_start();
    // コントローラ(C)
    // print 'OK';
    // $_POST, $_GET スーパーグローバル変数
    // var_dump($_POST);
    $name = $_POST['name'];
    $age = $_POST['age'];
    $id = $_POST['id'];
    // print $name;
    // print $age;
    
    $user = User::find($id);
    $user->name = $name;
    $user->age = $age;
    // var_dump($user);
    $errors = $user->validate();
    // var_dump($errors);
    
    if(count($errors) === 0){
        $flash_message = $user->save();
        // $_SESSION['new_user'] = $new_user;
        
        $_SESSION['flash_message'] = $flash_message;
        header('Location: index.php');
        exit;
        
    }else{
        $_SESSION['errors'] = $errors;
        header('Location: edit.php?id=' . $id);
        exit;
    }
    
    // var_dump($new_user);