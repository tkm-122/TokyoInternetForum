<?php
session_start();
if(isset($_SESSION['user']) != "" ){
  header("Location: home.php");
}

include_once 'dbconnect.php';

if(isset($_POST['signup'])){

  $username = $mysqli->real_escape_string($_POST['username']);
  $email = $mysqli->real_escape_string($_POST['email']);
  $password = $mysqli->real_escape_string($_POST['password']);
  $password = password_hash($password, PASSWORD_DEFAULT);

  $query = "INSERT INTO users(username,email,password) VALUES('$username','$email','$password')";

  if($mysqli->query($query)){  ?>
    <div class="alert alert-success" role="alert">登録しました</div>
  <?php } else { ?>
      <div class="alert alert-danger" role="alert">エラーが発生しました</div>
    <?php
  }
}


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
        <h1 class="title"> - 登録画面 - </h1>
        <form class="input" action="" method="post">
          <h4>ユーザー名</h4>
          <input type="text" class="form" name="username" placeholder="ユーザー名" required />
          <h4>メールアドレス</h4>
          <input type="email" class="form" name="email" placeholder="メールアドレス" required />
          <h4>パスワード</h4>
          <input type="password" class="form" name="password" placeholder="パスワード" required />
          <p></p>
          <button type="submit" class="btn" name="signup" >新規登録</button>
        </form>
        <div class="movement">
          <a href="login.php">ログイン画面へ戻る</a>
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
