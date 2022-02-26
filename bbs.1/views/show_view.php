<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title><?= $post->id ?>さんの詳細</title>
        <link rel="stylesheet" href="style.css">
    </head>
</html>
    <body>
        <h1><?= $post->id ?>さんの詳細</h1>
        <?php if($flash_message !== null): ?>
        <p class="message"><?= $flash_message ?></p>
        <?php endif; ?>
     
        <ul>
            <li><?= $post->id ?></li>
            <li><?= $post->name ?></li>
            <li><?= $post->title ?></li>
            <li><?= $post->content ?></li>
            <li><img src="upload/<?= $post->image ?>"></li>
            <li><?= $post->created_at ?></li>
        </ul>
        
        <h2>コメント一覧</h2>
        <form action="comment_store.php" method="POST">
            コメント: <input type="text" name="content">
            <input type="hidden" name="post_id" value="<?= $post->id ?>">
            <button type="submit">コメント投稿</button>
            
        </form>
        <ul>
            <?php foreach($comments as $comment): ?>
                <li><?= $comment->id ?>: <?= $comment->content ?> <?= $comment->name ?> / <?= $comment->created_at ?></li>
            <?php endforeach; ?>
        </ul>
        
        
        
        <p><a href="top.php">トップページへ</a></p>
        
        <?php if($post->user_id === $login_user->id): ?>
        <P><a href="post_edit.php?id=<?= $post->id ?>">編集</a></P>
        <form action="post_destroy.php" method="POST">
            <input type="hidden" name="id" value="<?= $post->id ?>">
            <button type="submit">削除</button>
        </form>
        <?php endif; ?>
    </body>
</html>    