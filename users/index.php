<?php
    require_once 'User.php';
    session_start();
    // $_SESSION['users'] = null;
    
    $users = $_SESSION['users'];
    
    if($users === null){
        $kubota = new User('久保田', 19);
        $shima = new User('島', 48);
        // $kubota->drink();
        // $kubota->talk($shima);
        
        $users = array();
        // $users = [];
        // array_push($users, $kubota);
        // array_push($users, $shima);
        // array_push($users, new User('木下', 25));
    }
    
    // $new_user = $_SESSION['new_user'];
    // $_SESSION['new_user'] = null;
    // if($new_user !== null){
    //     array_push($users, $new_user);
    // }
    // var_dump($users);
    
    $flash_message = $_SESSION['flash_message'];
    $_SESSION['flash_message'] = null;
    
    include_once 'index_view.php';