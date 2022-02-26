<?php
    require_once 'models/User.php';
    session_start();
    // var_dump($_POST);
    $id = $_POST['id'];
    $user = User::find($id);
    $user->destroy();
    $_SESSION['flash_message'] = $user->name . 'さんを削除しました';
    header('Location: index.php');
    exit;