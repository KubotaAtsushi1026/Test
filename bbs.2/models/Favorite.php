<?php
   class Favorite{
        public $id;
        public $user_id;
        public $post_id;
        public $created_at;
        public function __construct($user_id='', $post_id=''){
            $this->user_id = $user_id;
            $this->post_id = $post_id;
            // print $this->name . 'さんが生まれた' . PHP_EOL;
        }
        
        public function validate(){
            $errors = array();
            if($this->content === ''){
                $errors[] = '内容が入力されていません';
            }
            if($this->user_id === '' || $this->user_id === null){
                $errors[] = 'ユーザーIDを入力してください';
            }
            if($this->post_id === '' || $this->post_id === null){
                $errors[] = '投稿IDを入力してください';
            }
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
                $stmt = $pdo->query('SELECT posts.id, users.name, posts.title, posts.content, posts.image, posts.created_at FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.id DESC');
                // フェッチの結果を、Userクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Post');
                $posts = $stmt->fetchAll();
                self::close_connection($pdo, $stmp);
                // Userクラスのインスタンスの配列を返す
                return $posts;
            } catch (PDOException $e) {
                return 'PDO exception: ' . $e->getMessage();
            }
        }
        // データを1件登録するメソッド
        public function save(){
            try {
                $pdo = self::get_connection();
                if($this->id === null){
                    $stmt = $pdo -> prepare("INSERT INTO favorites (user_id, post_id) VALUES (:user_id, :post_id)");
                    // バインド処理
                    $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
                    $stmt->bindParam(':post_id', $this->post_id, PDO::PARAM_INT);
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
                return "新規いいねが成功しました。";
                }else{
                    return $this->id . "の投稿情報を更新しました";
                }
            } catch (PDOException $e) {
                return 'PDO exception: ' . $e->getMessage();
            }
        }
        public static function find($user_id, $post_id){
            try {
                $pdo = self::get_connection();
                $stmt = $pdo -> prepare("SELECT * FROM favorites WHERE user_id=:user_id AND post_id=:post_id");

                // バインド処理
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);                // 実行
                $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);                // 実行

                $stmt->execute();
                // フェッチの結果を、Userクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Favorite');
                $favorite = $stmt->fetch();
                self::close_connection($pdo, $stmp);
                if($favorite !== false){
                    return true;
                }else{
                    return false;
                }
                
            } catch (PDOException $e) {
                return 'PDO exception: ' . $e->getMessage();
            }
        }
        public static function destroy($user_id, $post_id){
            try {
                $pdo = self::get_connection();
                $stmt = $pdo -> prepare("DELETE FROM favorites WHERE user_id=:user_id AND post_id=:post_id");
                // バインド処理
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);                // 実行
                $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);                // 実行

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