<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>会員制写真投稿サイト</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>会員制写真投稿サイト</h1>
        <?php if($flash_message !== null): ?>
        <p class="message"><?= $flash_message ?></p>
        <?php endif; ?>
        
        <P><a href="create.php">新規ユーザー登録</a></P>
        <P><a href="login.php">ログイン</a></P>

        <!--<p><a href="destroy.php">全ユーザー削除</a></p>-->
    </body>
</html>