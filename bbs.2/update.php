<?php
    require_once 'models/User.php';
    session_start();
    // print 'OK';
    // var_dump($_POST);
    $name = $_POST['name'];
    $age = $_POST['age'];
    $id = $_POST['id'];
    // print $name;
    // print $age;
    $user = User::find($id);
    // var_dump($user);
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
    