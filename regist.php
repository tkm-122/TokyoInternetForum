  <?php
      session_start();
      include_once 'dbconnect.php';
      if(!isset($_SESSION['user'])){
        header("Location: login.php")
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


    $message = $_REQUEST['message'];
    $created = date('Y-m-d H:i:s');

    $result = $mysqli->query("INSERT INTO messages(user_id, message, created) VALUES('$id', '$message', '$created')");

    $mysqli->close();

  ?>


  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title>投稿結果</title>
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
          <div class="check">
            <?php
            if ($_POST['message'] === '') {
            exit('メッセージを記入してください');
            }
            ?>
          </div>
          <div class="answer">
            <h4>メッセージを投稿しました。</h4>
          </div>
          <div class="movement">
            <a href="main.php">一覧へ戻る</a><
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
