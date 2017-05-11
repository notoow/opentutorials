<?php
require_once('conn.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>title</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body id="body" class="white">
    <header>
      <h1><a href="index.php">생활코딩 JavaScript</a></h1>
    </header>
    <nav>
      <ol>
<?php
$sql  = "SELECT * FROM `topic`";
$result = mysqli_query($conn, $sql);//php가 데이터 서버에게 $sql을 보내는역할 그리고 서버가 다시 돌려준다
while( $row = mysqli_fetch_assoc($result)){//서버가 php에게 돌려준 값을 php가 알아먹을 수 있도록 하는 함수fetch가져오다
  echo '<li><a href="index.php?id='.$row['id'].'">'.htmlspecialchars($row['title']).'</a></li>';
}
?>
      </ol>
    </nav>
    <div id="content">
    <article>
      <form class="" action="process.php" method="post">
        <p>
          <label for="title">제목 :</label>
          <input id="title" type="text" name="title">
        </p>
        <p>
          <label for="author">저자 :</label>
          <input id="author" type="text" name="author" value="">
        </p>
        <p>
          <label for="description">본문 :<lebel>
          <textarea id="description" name="description" rows="8" cols="80"></textarea>
        </p>
        <p>
          <input type="submit" value="전송">
        </p>
      </form>
    </article>
<div class="button">
    <input type="button" name="name" value="White" onclick="document.getElementById('body').className='white'">
    <input type="button" name="name" value="Black" onclick="document.getElementById('body').className='black'">
    <a href="write.php">쓰기</a>
</div>
  </div>

  </body>
</html>
