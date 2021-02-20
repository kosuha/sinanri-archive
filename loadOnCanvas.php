<?php

    require('lib/conn.php');
    require('lib/session.php');

    $selectHouse = $_POST['selectHouse'];

    //해당 건물에 그림이 있는지 확인
    $sql = "SELECT houseName FROM canvasData WHERE houseName = '{$selectHouse}'";
    $res = $conn->query($sql);

    //있다면 가져오기
    if($res->num_rows >= 1){
      $sql_0 = "SELECT imgData FROM canvasData WHERE houseName = '{$selectHouse}'";
      $result = $conn->query($sql_0);
      $row_0 = mysqli_fetch_array($result);
      echo json_encode(array('res'=>$row_0[0]));
    }
?>
