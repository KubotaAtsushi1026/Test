<?php
    require_once 'models/User.php';
    session_start();
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
   
    $new_user = new User($name, $email, $password);
    
    // var_dump($new_user);
    
    $errors = $new_user->validate();
    // var_dump($errors);
    if(count($errors) === 0){
        
        $flash_message = $new_user->save();   
    
        // $_SESSION['new_user'] = $new_user;
        $_SESSION['flash_message'] = $flash_message;
        header('Location: index.php');
        exit;
    }else{
        $_SESSION['errors'] = $errors;
        header('Location: create.php');
        exit;
    }
    