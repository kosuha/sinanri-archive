<?php
  require('lib/conn.php');
  require('lib/session.php');

  $lastSeq = $_POST['lastSeq'];
  $showNum = $_POST['showNum'];

//남은 post의 갯수
  $count = "SELECT COUNT(*) as cnt FROM generalForum WHERE postSeq<'{$lastSeq}'";
  $count_result = mysqli_query($conn, $count);
  $cnt = mysqli_fetch_array($count_result);

//등록된 post를 $list 배열에 저장

if($cnt['cnt'] < $showNum){ //남은 포스트가 %개 미만일 경우

  $sql = "SELECT * FROM generalForum WHERE postSeq<'{$lastSeq}' ORDER BY postSeq DESC";
  $result = mysqli_query($conn, $sql);
  $list1 = array();
  $list2 = array();
  $list3 = array();

  for($i = 0; $i < $cnt['cnt']; $i++){
    $row = mysqli_fetch_array($result);
    array_push($list1, $row[1]);
    array_push($list2, $row[2]);
    array_push($list3, $row[3]);
  }

  echo json_encode(array(
    'res_content'=>$list1,
    'res_nickname'=>$list3,
    'res_created'=>$list2,
    'res_lastPostSeq'=>'end',
    'res_num'=>$cnt['cnt']
  ));

} else {

  $sql = "SELECT * FROM generalForum WHERE postSeq<'{$lastSeq}' ORDER BY postSeq DESC LIMIT $showNum";
  $result = mysqli_query($conn, $sql);
  $list1 = array();
  $list2 = array();
  $list3 = array();
  $list4 = array();

  for($i = 0; $i < $showNum; $i++){
    $row = mysqli_fetch_array($result);
    array_push($list1, $row[1]);
    array_push($list2, $row[2]);
    array_push($list3, $row[3]);
    array_push($list4, $row[0]);
  }

  echo json_encode(array(
    'res_content'=>$list1,
    'res_nickname'=>$list3,
    'res_created'=>$list2,
    'res_lastPostSeq'=>$list4[$showNum-1],
    'res_num'=>false
  ));
}

?>
