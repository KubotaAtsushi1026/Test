<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title><?= $post->id ?>の詳細</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <!-- ビュー(V)-->
        <h1><?= $post->id ?>の詳細</h1>
        <?php if($flash_message !== null): ?>
        <P class="message"><?= $flash_message ?></P>
        <?php endif; ?>
        <ul>
            <li><?= $post->id ?></li>
            <li><?= $post->name ?></li>
            <li><?= $post->title ?></li>
            <li><?= $post->content ?></li>
            <li><img src="upload/<?= $post->image ?>"></li>
            <li><?= $post->created_at ?></li>

        </ul>
        
        <p><a href="top.php">トップページへ</a></p>
        
        <?php if($post->user_id === $login_user->id ): ?>
        <p><a href="post_edit.php?id=<?= $post->id ?>">編集</a></p>
        <form action="post_destroy.php" method="POST">
            <input type="hidden" name="id" value="<?= $post->id ?>">
            <button type="submit">削除</button>
        </form>
        <?php endif; ?>
    </body>
</html>