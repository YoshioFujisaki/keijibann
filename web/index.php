<?php

require ('../app/function.php');

require('../app/database.php');

include('../app/header.php');
?>

  <h1>掲示板</h1>
  <section class="post">
    <div class="container">
      <form action="" method="post">
      <h2>新規投稿</h2>
        <p>名前</p><input type="text" name="username"></br>
        <p>内容</p><textarea type="text" name="comment" cols="80" rows="4" ></textarea></br>
        <button type="submit" name="submitButton" value="投稿">投稿</button>
      </form>
    </div>
  </section>
  <section class="receive">
    <h1>投稿一覧</h1>
    <?php foreach($comment_array as $comment): ?>
      <article>
        <div class="container">
        <div class="wrapper">
          <div class="namearea">
            <span>名前：</span>
            <p class="username"><?php echo h($comment["username"]); ?></p>
            <time>:<?php echo $comment["postDate"]; ?></time>
          </div>
          <p class="comment"><?php echo h($comment["comment"]); ?></p>
        </div>
      </div>
    </article>
    <?php endforeach; ?>
  </section>
<?php include('../app/footer.php');
