<?php
  session_start();
  include_once 'dbconnect.php';
  if(!isset($_SESSION['user'])){
    header("Location: login.php");
  }


$query = "SELECT *FROM users WHERE id=".$_SESSION['user']."";
$result = $mysqli->query($query);
if(!$result){
  print('クエリーが失敗しました。'.$mysqli->error);
  $mysqli->close();
  exit();
}


while($row = $result->fetch_assoc()){
  $username = $row['username'];
  $id = $row['id'];
}

$result->close();

if(isset($_POST['username'])){

$re_username = $mysqli->real_escape_string($_POST['username']);

  if($re_username == $username ){
    echo "エラーが発生しました。";
    }else{
    $rename = "UPDATE users SET username ='". $re_username."'  WHERE id =". $id."";
         if($mysqli->query($rename)){
             echo "名前を変更しました。";
             }else{
             echo "error";
             }
   }
}
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>変更画面</title>
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
        <div class="main-form">
          <form class="input" action="" method="post">
            <ul>
              <li>名前：<?php echo htmlspecialchars($username) ; ?></li>
              <input type="text" class="form" name="username" placeholder="ユーザー名" required />
            <button type="submit" class="btn" name="signup" >変更する</button>
          </form>
        </div>
        <div class="movement">
          <a href="home.php">戻る</a>
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
