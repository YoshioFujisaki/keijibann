<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  header('Location:http://localhost/sns/web/index.php');
}

date_default_timezone_set('Asia/Tokyo');

$comment_array = array();
$stmt = null;
$error_messages = array();

//DB接続
try {
  $pdo = new PDO('mysql:host=localhost;dbname=sns', "root", "gks0716kj");
} catch(PDOException $e) {
    echo $e->getMessage();
}

//フォームを打ち込んだ時
if(!empty($_POST["submitButton"])) {
  
  
  //名前のチェック
  if (empty($_POST['username'])) {
    echo "名前の入力をしてください。";
    $error_messages["username"] = "名前の入力をしてください。";
  }

  if (empty($_POST['comment'])) {
    echo "コメントの入力をしてください。";
    $error_messages["comment"] = "コメントの入力をしてください。";
  }

  if(empty($error_messages)) {
    $postDate = date("Y-m-d H:i:s");
 
    try {
      $stmt = $pdo->prepare("INSERT INTO `sns-post` (`username`, `comment`, `postDate`) VALUES (:username, :comment, :postDate);");
      $stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
      $stmt->bindParam(':comment', $_POST['comment'], PDO::PARAM_STR);
      $stmt->bindParam(':postDate', $postDate, PDO::PARAM_STR);
  
      $stmt->execute();
    } catch(PDOException $e) {
      echo $e->getMessage();
    }
  }
}

//DBからコメントデータを取得する。
$sql = "SELECT `id`, `username`, `comment`, `postDate` FROM `sns-post`;";
$comment_array = $pdo->query($sql);

//DBの接続を閉じる
$pdo = null;
