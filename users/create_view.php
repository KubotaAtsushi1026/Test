<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charser="UTF-8">
        <link rel="stylesheet" href="style.css">
        <title>新規ユーザー登録</title>
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
            年齢: <input type="text" name="age"><br>
            <!--<input type="submit" value="登録">-->
            <button type="submit">登録</button>
        </form>    
        <p><a href="index.php">ユーザー一覧に戻る</a></p>
    </body>
</html>