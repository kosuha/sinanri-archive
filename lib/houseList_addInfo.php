<?php
  require('lib/conn.php');
  require('lib/session.php');

//등록된 house 갯수
  $count = "SELECT COUNT(*) as cnt FROM houseName";
  $count_result = mysqli_query($conn, $count);
  $cnt = mysqli_fetch_array($count_result);

//등록된 house를 $list 배열에 저장
  $sql = "SELECT * FROM houseName ORDER BY id DESC";
  $result = mysqli_query($conn, $sql);
  $list = array();
  for($i = 0; $i < $cnt['cnt']; $i++){
    $row = mysqli_fetch_array($result);
    array_push($list, $row['houseName']);
  }

  for($i = 0; $i < $cnt['cnt']; $i++){
    echo "<option value=\"$list[$i]\">$list[$i]</option>";
  }
?>
