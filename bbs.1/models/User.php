<?php
    // print("こんにちは\n");
    // print('こんにちは' . PHP_EOL);
    // print'こんにちは' . PHP_EOL;
    class User{
        public $id;
        public $name;
        public $email;
        public $password;
        public $created_at;
        public function __construct($name="", $email="",$password=""){
            $this->name = $name;
            $this->email = $email;
            $this->password =$password;
            // print $this->name . 'さんが生まれた' . PHP_EOL;
        }
          // 入力チェックをするメソッド
        public function validate(){
            // 空のエラー配列作成
            $errors = array();
            // 名前が入力されていなければ
            if($this->name === ''){
                $errors[] = '名前が入力されていません';
            }
            // 年齢が入力されていなければ
            if($this->email === ''){
                $errors[] = 'メールアドレスを入力してください';
            }else if(!preg_match('/^[a-zA-Z0-9_+-]+(.[a-zA-Z0-9_+-]+)*@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}$/', $this->email)){ // 年齢が正の整数でなければ
                $errors[] = 'メールアドレスは正しく入力してください';
            }
            if($this->password === ''){
                $errors[] = 'パスワードを入力してください';
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
                $stmt = $pdo->query('SELECT * FROM users ORDER BY id DESC');
                // フェッチの結果を、Userクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
                $users = $stmt->fetchAll();
                self::close_connection($pdo, $stmp);
                // Userクラスのインスタンスの配列を返す
                return $users;
            } catch (PDOException $e) {
                return 'PDO exception: ' . $e->getMessage();
            }
        }public function save(){
            try {
                $pdo = self::get_connection();
                
                if($this->id === null){
                    $stmt = $pdo -> prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
                    // バインド処理
                    $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
                    $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
                    $stmt->bindParam(':password', $this->password, PDO::PARAM_STR);

                    // 実行
                    $stmt->execute();
                    
                }else{
                    $stmt = $pdo -> prepare("UPDATE users SET name=:name, age=:age WHERE id=:id");
                    // バインド処理
                    $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
                    $stmt->bindParam(':age', $this->age, PDO::PARAM_INT);
                    $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

                    // 実行
                    $stmt->execute();
                }
                self::close_connection($pdo, $stmp);
                if($this->id === null){
                return "新規ユーザー登録が成功しました。";
                    
                }else{
                    return $this->name . 'さんの情報を更新しました';
                }
                
            } catch (PDOException $e) {
                return 'PDO exception: ' . $e->getMessage();
            }
        }
        public static function find($id){
            try {
                $pdo = self::get_connection();
                $stmt = $pdo -> prepare("SELECT * FROM users WHERE id=:id");
                // バインド処理
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);                // 実行
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
        public function destroy(){
             try {
                $pdo = self::get_connection();
                $stmt = $pdo -> prepare("DELETE FROM users WHERE id=:id");
                // バインド処理
                $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);                // 実行
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