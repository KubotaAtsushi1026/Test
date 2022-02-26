<?php
    // print("こんにちは\n");
    // print('こんにちは' . PHP_EOL);
    // print'こんにちは' . PHP_EOL;
    class Comment{
        public $id;
        public $user_id;
        public $post_id;
        public $content;
        public $created_at;
        public function __construct($user_id="", $post_id="", $content=""){
            $this->user_id = $user_id;
            $this->post_id = $post_id;
            $this->content = $content;
            // print $this->name . 'さんが生まれた' . PHP_EOL;
        }
          // 入力チェックをするメソッド
        public function validate(){
            // 空のエラー配列作成
            $errors = array();
            // 名前が入力されていなければ
            if($this->title === ''){
                $errors[] = 'タイトルが入力されていません';
            }
            // 年齢が入力されていなければ
            if($this->content === ''){
                $errors[] = '本文を入力してください';
            }
            if($this->image === ''){
                $errors[] = '画像を選択してください';
            }
            // 完成したエラー配列はいあげる
            return $errors;
        }
        private static function get_connection(){
            try {
                // オプション設定
                $options = array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        // 失敗したら例外を投げる
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_CLASS,   //デフォルトのフェッチモードはクラス
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',   //MySQL サーバーへの接続時に実行するコマンド
                  );
                $pdo = new PDO('mysql:host=localhost;dbname=bbs_app', 'root', '', $options);
                return $pdo;
                
            } catch (PDOException $e) {
                return 'PDO exception: ' . $e->getMessage();
        }
    }

// データベースとの切断を行うメソッド
        private static function close_connection($pdo, $stmp){
            try {
                $pdo = null;
                $stmp = null;
            } catch (PDOException $e) {
                return 'PDO exception: ' . $e->getMessage();
            }
        }
        
// 全テーブル情報を取得するメソッド
        public static function all(){
            try {
                $pdo = self::get_connection();
                $stmt = $pdo->query('SELECT posts.id, users.name, posts.title, posts.content, posts.image, posts.created_at FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.id desc');
                // フェッチの結果を、Postクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Post');
                $posts = $stmt->fetchAll();
                self::close_connection($pdo, $stmp);
                // Postクラスのインスタンスの配列を返す
                return $posts;
            } catch (PDOException $e) {
                return 'PDO exception: ' . $e->getMessage();
            }
        }
        public function save(){
            try {
                $pdo = self::get_connection();
                
                if($this->id === null){
                $stmt = $pdo -> prepare("INSERT INTO comments (user_id, post_id, content) VALUES (:user_id, :post_id, :content)");
                // バインド処理
                $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
                $stmt->bindParam(':post_id', $this->post_id, PDO::PARAM_INT);
                $stmt->bindParam(':content', $this->content, PDO::PARAM_STR);
                // 実行
                $stmt->execute();
                    
                }else{
                     $stmt = $pdo -> prepare("UPDATE posts SET title=:title, content=:content, image=:image WHERE id=:id");
                     // バインド処理
                     $stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
                     $stmt->bindParam(':content', $this->content, PDO::PARAM_STR);
                     $stmt->bindParam(':image', $this->image, PDO::PARAM_STR);
                     $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
                     // 実行
                     $stmt->execute();
                }
                
                self::close_connection($pdo, $stmp);
                if($this->id === null){
                    return "新規コメント投稿が成功しました。";
                }else{
                    return $this->id. 'の投稿情報を更新しました';
                }
                
            } catch (PDOException $e) {
                return 'PDO exception: ' . $e->getMessage();
            }
        }
        public static function find($id){
            try {
                $pdo = self::get_connection();
                $stmt = $pdo -> prepare("SELECT posts.user_id, posts.id, posts.title, posts.content, posts.image, posts.created_at, users.name FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id=:id");
                // バインド処理
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);                // 実行
                $stmt->execute();
                 // フェッチの結果を、Userクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Post');
                $post = $stmt->fetch();
                self::close_connection($pdo, $stmp);
                return $post;
                
            } catch (PDOException $e) {
                return 'PDO exception: ' . $e->getMessage();
            }
        }
        public static function destroy($id){
             try {
                $pdo = self::get_connection();
                $stmt = $pdo -> prepare("DELETE FROM posts WHERE id=:id");
                // バインド処理
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);                // 実行
                $stmt->execute();
             
                
            } catch (PDOException $e) {
                return 'PDO exception: ' . $e->getMessage();
            }
        }
        public static function login($email, $password){
            try {
                $pdo = self::get_connection();
                $stmt = $pdo -> prepare("SELECT * FROM users WHERE email=:email AND password=:password");
                // バインド処理
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':password', $password, PDO::PARAM_STR);

                // 実行
                $stmt->execute();
                 // フェッチの結果を、Userクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
                $user = $stmt->fetch();
                self::close_connection($pdo, $stmp);
                return $user;
                
            } catch (PDOException $e) {
                return 'PDO exception: ' . $e->getMessage();
            }
        }
    
        
    }