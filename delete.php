<?php
  session_start();
  include_once 'dbconnect.php';
  if(!isset($_SESSION['user'])){
    header("Location: main.php");
  }
?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>削除結果</title>
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
           if(empty($_POST)){
             echo "<a href='main.php'>ページに戻る</a>";
             exit();
           }else{
             if(!isset($_POST['no']) || !is_numeric($_POST['no']) ){
               echo "IDエラー";
               exit();
             }else{

               $stmt = $mysqli->prepare("DELETE FROM messages WHERE no=?");

               if($stmt){
                 $stmt->bind_param('i',$no);
                 $no=$_POST['no'];

                 $stmt->execute();

                 if($stmt->affcted_rows == 0 ){
                   echo "削除しました。";
                 }else{
                   echo "削除失敗です。";
                 }

                 $stmt->close();
               }else{
                 echo $mysqli->errno . $mysqli->error;
               }
             }
           }

           $mysqli->close();

           ?>
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
