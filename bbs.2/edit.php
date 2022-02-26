<?php
    require_once 'models/User.php';
    session_start();
    // var_dump($_GET);
    $id = $_GET['id'];
    // print $id;
    $user = User::find($id);
    // var_dump($user);
    $errors = $_SESSION['errors'];
    $_SESSION['errors'] = null;
    
    include_once 'views/edit_view.php';