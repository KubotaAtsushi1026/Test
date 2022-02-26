<?php
    session_start();
    $_SESSION['users'] = null;
    
    $_SESSION['flash_message'] = '全ユーザーを削除しました';
    header('Location: index.php');
    exit;