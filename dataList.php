<?php
  require('lib/session.php');
  require('lib/sessionCheck.php');
  require('lib/conn.php');

//   $memberId = $_SESSION['ses_userid'];
  $selectHouse = $_POST['selectHouse'];

  $sql_= "SELECT address FROM houseName WHERE houseName = '{$selectHouse}'";
  $sql_result_ = mysqli_query($conn, $sql_);
  $row = mysqli_fetch_array($sql_result_);
  $addr = $row[0];

//등록된 post의 갯수
  $count = "SELECT COUNT(*) as cnt FROM data LEFT JOIN houseName ON data.houseName_id = houseName.id WHERE houseName = '{$selectHouse}'";
  $count_result = mysqli_query($conn, $count);
  $cnt = mysqli_fetch_array($count_result);

//등록된 post를 $list 배열에 저장
  $sql = "SELECT * FROM data LEFT JOIN houseName ON data.houseName_id = houseName.id LEFT JOIN member ON data.memberId = member.memberId WHERE houseName = '{$selectHouse}' ORDER BY data.id DESC";
  $result = mysqli_query($conn, $sql);
  
  $list2 = array();
  $list3 = array();
  $list4 = array();
  for($i = 0; $i < $cnt['cnt']; $i++){
    $row = mysqli_fetch_array($result);
    
    array_push($list2, $row[3]);
    array_push($list3, $row[14]);
    array_push($list4, $row[4]);
  }

  echo json_encode(array(
    'res_addr'=>$addr,
    'res_review'=>$list2,
    'res_nick'=>$list3,
    'res_created'=>$list4
  ));
?>
