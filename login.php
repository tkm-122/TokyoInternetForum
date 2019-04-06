<?php
  ob_start();
  session_start();
  if(isset($_SESSION['user'] !="")){
    header("Location: home.php");
  }
include_once 'dbconnect.php';

//ログインボタンがクリックされた時下記実行
if(isset($_POST['login'])){

  $email = $mysqli->real_escape_string($_POST['email']);
  $password = $mysqli->real_escape_string($_POST['password']);
}
//クエリの実行
$query = "SELECT * FROM users WHERE email = '$email'";
$result = $mysqli->query($query);
if(!$result){
  print('クエリーが失敗しました。' .$mysqli->error);
  $mysqli->close();
  exit();
}

//パスワードとユーザーのIDの取り出し
while($row = $result->fetch_assoc()){
  $db_hashed_pwd = $row['password'];
  $id = $row['id'];
}

//データベースの切断
$result->close();

// ハッシュ化されたパスワードがマッチするかどうかを確認
 if (password_verify($password, $db_hashed_pwd)) {
   $_SESSION['user'] = $id;
   header("Location: main.php");
   exit;
 } else { ?>
   <div class="alert alert-danger" role="alert">メールアドレスとパスワードが一致しません。</div>
 <?php }

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </head>
  <body>
    <header>
      <div class="header-left">
        <span class="fab fa-qq"></span>
        <h2>  Tokyo Internet Forum</h2>
      </div>
      <div class="clear"></div>
    </header>
    <div class="main">
      <div class="container">
        <h1 class="title"> - ログイン画面 - </h1>
        <form class="input" method="post">
          <h4>メールアドレス</h4>
          <input type="email" class="form" name="email" placeholder="メールアドレス" required />
          <h4>パスワード</h4>
          <input type="password" class="form" name="password" placeholder="パスワード" required />
          <p></p>
          <button type="submit" class="btn" name="login">ログイン</button>
        </form>
        <div class="movement">
          <a href="register.php">新規登録はこちら</a>
        </div>
      </div>
    </div>
    <footer>
      <div class="footer-center">
        <h2><span class="fab fa-qq"></span>Tokyo Internet Forum</h2>
      </div>
      <div class="clear"></div>
    </footer>
  </body>
</html>
