<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>MyTop</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>会員制写真投稿サイト</h1>
        <?php if($flash_message !== null): ?>
        <p class="message"><?= $flash_message ?></p>
        <?php endif; ?>
        
        <h2><?= $login_user->name ?>さん、ようこそ！</h2>
        
        <P><a href="post_create.php">新規写真投稿</a></P>
        
        <?php if(count($posts) === 0): ?>
        <p>まだ投稿は1件もありません</p>
        <?php else: ?>
        <table>
            <tr>
                <th>投稿番号</th>
                <th>投稿者</th>
                <th>タイトル</th>
                <th>本文</th>
                <th>画像</th>
                <th>投稿日時</th>
            </tr>
            <?php foreach($posts as $post): ?>
            <tr>
                <td><a href="show.php?id=<?= $post->id?>"><?= $post->id ?></a></td>
                <td><?= $post->name ?></td>
                <td><?= $post->title ?></td>
                <td><?= $post->content ?></td>
                <td><img src="upload/<?= $post->image ?>" alt="<?= $post->image ?>"></td>
                <td><?= $post->created_at ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
        
        <P><a href="logout.php">ログアウト</a></P>

        <!--<p><a href="destroy.php">全ユーザー削除</a></p>-->
    </body>
</html>