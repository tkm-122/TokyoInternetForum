<?php
  session_start();
  include_once 'dbconnect.php';
  if(!isset($_SESSION['user'])){
    header("Location: login.php")
  }

//ユーザーIDからユーザー名を取り出す
$query = "SELECT *FROM users WHERE id=".$_SESSION['user']."";
$result = $mysqli->query($query);
if(!$result){
  print('クエリーが失敗しました。'.$mysqli->error);
  $mysqli->close();
  exit();
}

//ユーザー情報の取り出し
while($row = $result->fetch_assoc()){
  $username = $row['username'];
  $email = $row['email'];
}

$result->close();

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>マイプロフィール</title>
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
        <h1 class="title"> - プロフィール - </h1>
        <ul>
          <li>名前：<?php echo $username; ?></li>
          <li>メールアドレス：<?php echo $email; ?></li>
        </ul>
        <div class="movement">
          <a href="logput.php?logout">ログアウト</a>
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
