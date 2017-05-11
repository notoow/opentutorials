<?php

//데이터베이스 접속
require_once('conn.php');

//저자가 user 테이블에 존재하는지 여부를 체크
$author = mysqli_real_escape_string($conn,$_POST['author']);
$sql = "SELECT * FROM `user` WHERE `name` = '".$author."'";
//$sql = "SELECT * FROM `user` WHERE `name` = '{$author}'";

//user_id 알아내기!!!!!!
$result = mysqli_query($conn, $sql);
if($result->num_rows > 0){

//존재한다면 user.id을 알아낸다
  $row = mysqli_fetch_assoc($result);
  $user_id = $row['id'];
}else{

//존재하지 않는다면 저자를 user 테이블에 추가 후 id를 알아낸다
  $sql = "INSERT INTO user (id, name, password) VALUES(NULL, '{$author}', '');";
  mysqli_query($conn, $sql);

//방금 인서트한 테이블에 추가된 행의 아이디를 알아내기
  $user_id = mysqli_insert_id($conn);
}

$title = mysqli_real_escape_string($conn, $_POST['title']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$sql = "INSERT INTO
          `topic`
                 (`id`, `title`, `description`, `author`, `created`)
          VALUES (NULL, '{$title}', '{$description}', '{$user_id}', now());";

/////////$sql = "INSERT INTO" `user` (`id`, `name`) VALUES (NULL, '{$user_id}')
mysqli_query($conn, $sql);

//사용자를 index.php로 이동(리다이렉션)
header('location: index.php');

//제목,저자,본문 등을 topic 테이블에 추가
//print_r($_POST);//배열에 접근하는 print_r이거 정리7의 19분에 설명 잘 되어있음
 ?>
