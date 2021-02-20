<?php

    require('lib/conn.php');
    require('lib/session.php');

    $canvasData = $_POST['canvasData'];
    $selectHouse = $_POST['selectHouse'];

    $sql = "SELECT houseName FROM canvasData WHERE houseName = '{$selectHouse}'";
    $res = $conn->query($sql);

    if($res->num_rows >= 1){
      $sql = "UPDATE canvasData SET imgData = '{$canvasData}', created = NOW(), memberId = '{$_SESSION['ses_userid']}' WHERE houseName = '{$selectHouse}'";
    } else {
      $sql = "INSERT INTO canvasData
            (memberId,
            created,
            imgData,
            houseName)
              VALUES(
                  '{$_SESSION['ses_userid']}',
                  NOW(),
                  '{$canvasData}',
                  '{$selectHouse}'
              )
          ";
    }
    $result = mysqli_query($conn, $sql);

?>
