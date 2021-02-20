<?php
    $count = "SELECT COUNT(*) as cnt FROM canvasData";
    $count_result = $conn->query($count);
    $cnt = mysqli_fetch_array($count_result);

    $sql = "SELECT canvasData.imgData, houseName.address FROM canvasData INNER JOIN houseName ON canvasData.houseName = houseName.houseName";

    $res = $conn->query($sql);

    $list1 = array();
    $list2 = array();
    for($i = 0; $i < $cnt['cnt']; $i++){
      $row = mysqli_fetch_array($res);
      array_push($list1, $row['imgData']);
      array_push($list2, $row['address']);
    }
    echo "
      var addrData = [];
      var imgData = [];
    ";

    for($i = 0; $i < $cnt['cnt']; $i++){
      echo "
          imgData.push('$list1[$i]');
          addrData.push('$list2[$i]');
      ";
    }
?>
