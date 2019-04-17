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
  while($key = $result->fetch_assoc()){
    $username = $key['username'];
    $userid = $key['id'];
  }
 $result->close();

 $sql = 'SELECT * FROM messages ORDER BY no DESC' ;
 $messages = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>掲示板</title>
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
        <h1 class="title"> - 掲示板 - </h1>
        <h5>ようこそ
          <a href="home.php"><?php  echo htmlspecialchars($username); ?></a>
          さん</h5>

        <div class="main-form">
          <form action="regist.php" method="post">
            メッセージ：<br />
            <textarea class="form" name="message" cols="30" rows="5"></textarea><br />
            <br />
            <input type="submit" class="btn" value="投稿する" />
          </form>
        </div>

        <div class="display">
         <?php
               $sql = 'SELECT * FROM messages ORDER BY no DESC' ;
               $result = $mysqli->query($sql);
         ?>

         <?php foreach($messages as $row) : ?>

         <?php
            $users = "SELECT * FROM users WHERE id=".$row['user_id']."";
            $user = $mysqli->query($users);

            while($fin = $user->fetch_assoc()){
              $user_name = $fin['username'];
              }
         ?>

        <h3> <?php
               echo '[No.' . $row['no'] . '] ';
               echo htmlspecialchars($user_name.'さん ');
               echo $row['created'];
               ?>

             <?php if($userid == $row['user_id']): ?>
                 <form action="delete.php" method="post">
                    <button type="submit" > <i class="fas fa-comment-slash"></i>
                    削除
                    <input type="hidden" name="no" value="<?=$row['no']?>">
                    </button>
                 </form>
            <?php endif; ?>

            <?php
                 echo "<br >";
                 echo "<br />\n";
                 echo nl2br(htmlspecialchars($row['message'], ENT_QUOTES));
            ?></h3>
           <?php endforeach ?>
           <?php $mysqli->close() ?>
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
