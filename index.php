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
      <h1><a href="index.php">JavaScript</a></h1>
    </header>
    <nav>
      <ol>
<?php
$sql  = "SELECT * FROM `topic`";//토픽의 모든 데이터를 가져와
$result = mysqli_query($conn, $sql);//php가 데이터 서버에게 $sql을 보내는역할 그리고 서버가 다시 돌려준다(데이터베이스에질의)
while( $row = mysqli_fetch_assoc($result)){//서버가 php에게 돌려준 값을 php가 알아먹을 수 있도록 하는 함수fetch가져오다(화면표시)
  echo '<li><a href="index.php?id='.$row['id'].'">'.htmlspecialchars($row['title']).'</a></li>';
}
?>
      </ol>
    </nav>
    <div id="content">
    <article>

<?php
if(empty($_GET['id'])){
  echo "Welcome";
}else{
//id값을 받아서 sql문을 만들어야 되기 때문에 id값을 변수화 (받아들일 때 ㄹㅇ이스케이프, 출력할땐 htmlspecialchars)
  $id = mysqli_real_escape_string ($conn, $_GET['id']);//(주소창에서)공격가능성에서 벗어남, 첫번째 인자를 conn으로 줘야함
//토픽을 본문에 표현(//WHERE은 topic.id 값이 $id 에 해당하는 것만 가지고옴)
  $sql = "SELECT topic.id, topic.title, topic.description, user.name, topic.created
          FROM topic LEFT JOIN user ON topic.author = user.id
          WHERE topic.id=".$id;
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  ?>
  <h2><?=htmlspecialchars($row['title'])?></h2>
  <div><?=htmlspecialchars($row['created'])?> | <?=htmlspecialchars($row['name'])?></div>
  <div><?=htmlspecialchars($row['description'])?></div>
  <?php
}

?>
<div class="button">
<input type="button" name="name" value="White" onclick="document.getElementById('body').className='white'">
<input type="button" name="name" value="Black" onclick="document.getElementById('body').className='black'">
<a href="write.php">쓰기</a>
</div>
    </article>
  </div>

  </body>
</html>
