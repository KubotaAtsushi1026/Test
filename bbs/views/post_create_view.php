<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>新規写真</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>新規写真登録</h1>
        <?php if($errors !== null): ?>
        <ul>
        <?php foreach($errors as $error): ?>
        <li class="error"><?= $error ?></li>
        <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <form action="post_store.php" method="POST" enctype="multipart/form-data">
            タイトル: <input type="text" name="title"><br>
            本文: <input type="text" name="content"><br>
            画像: <input type="file" name="image"><br>
            <button type="submit">投稿</button>
        </form>
        <P><a href="top.php">MyTopに戻る</a></P>
    </body>
</html>