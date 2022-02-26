<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>新規ユーザー登録</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>新規ユーザー登録</h1>
        <?php if($errors !== null): ?>
        <ul>
        <?php foreach($errors as $error): ?>
        <li class="error"><?= $error ?></li>
        <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <form action="store.php" method="POST">
            名前: <input type="text" name="name"><br>
            メールアドレス: <input type="text" name="email"><br>
            パスワード: <input type="password" name="password"><br>
            <button type="submit">登録</button>
        </form>
        <P><a href="index.php">トップページに戻る</a></P>
    </body>
</html>