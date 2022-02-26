<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charser="UTF-8">
        <link rel="stylesheet" href="style.css">
        <title>ユーザー一覧</title>
    </head>
    <body>
        <h1>ユーザー一覧</h1>
        <?php if($flash_message !== null): ?>
        <P class="message"> <?= $flash_message ?></P>
        <?php endif; ?>
        <?php if(count($users) === 0): ?>
        <P>ユーザーはまだいません</P>
        <?php else: ?>
        <P>ユーザー人数: <?= count($users) ?>人</P>
        <?php foreach($users as $user): ?>
        <ul>
            <li><?= $user->name ?></li>
            <li><?= $user->age . '歳' ?></li>
        </ul>
        <?php endforeach; ?>
        <?php endif; ?>
        <p><a href="create.php">新規ユーザー登録</a></p>
        <p><a href="destroy.php">全ユーザー削除</s></p>
    </body>
</html>