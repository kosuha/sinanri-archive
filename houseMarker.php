<?php

    require('lib/conn.php');

    $count = "SELECT COUNT(*) as cnt FROM houseName";
    $count_result = $conn->query($count);
    $cnt = mysqli_fetch_array($count_result);

    $sql = "SELECT * FROM houseName";
    $res = $conn->query($sql);

    $list1 = array();
    $list2 = array();
    for($i = 0; $i < $cnt['cnt']; $i++){
      $row = mysqli_fetch_array($res);
      array_push($list1, $row['houseName']);
      array_push($list2, $row['address']);
    }
    echo "
      var houseNameDB = [];
      var addressDB = [];
    ";

    for($i = 0; $i < $cnt['cnt']; $i++){
      echo "
          houseNameDB.push('$list1[$i]');
          addressDB.push('$list2[$i]');
      ";
    }

?>
