<?php
  require('lib/session.php');
  require('lib/sessionCheck.php');
  require('lib/conn.php');

  $memberId = $_SESSION['ses_userid'];

//등록된 post의 갯수
  $count = "SELECT COUNT(*) as cnt FROM data WHERE memberId = '{$memberId}'";
  $count_result = mysqli_query($conn, $count);
  $cnt = mysqli_fetch_array($count_result);

//등록된 post를 $list 배열에 저장
  $sql = "SELECT * FROM data LEFT JOIN houseName ON data.houseName_id = houseName.id WHERE memberId = '{$memberId}' ORDER BY data.id DESC";

  $result = mysqli_query($conn, $sql);
  $list1 = array();
  $list2 = array();
  $list3 = array();
  $list4 = array();
  for($i = 0; $i < $cnt['cnt']; $i++){
    $row = mysqli_fetch_array($result);
    array_push($list1, $row[7]);
    array_push($list2, $row[0]);
    array_push($list3, $row[3]);
    array_push($list4, $row[4]);
  }

  for($i = 0; $i < count($list1); $i++){
    echo "<div>
          <p class=\"houseName\">$list1[$i]</p>
          <p class=\"review\">\"$list3[$i]\"</p>
          <p class=\"created\">$list4[$i]</p>
          <p class=\"del\" onClick=\"cf($list2[$i])\">삭제</p>
          </div>
          ";
  }
?>
