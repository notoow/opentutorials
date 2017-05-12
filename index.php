<?php
require_once('conn.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 위 3개의 메타 태그는 *반드시* head 태그의 처음에 와야합니다; 어떤 다른 콘텐츠들은 반드시 이 태그들 *다음에* 와야 합니다 -->
    <meta charset="utf-8">
    <title>title</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- IE8 에서 HTML5 요소와 미디어 쿼리를 위한 HTML5 shim 와 Respond.js -->
        <!-- WARNING: Respond.js 는 당신이 file:// 을 통해 페이지를 볼 때는 동작하지 않습니다. -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
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
  <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
