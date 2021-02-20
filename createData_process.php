<?php
require('lib/conn.php');
require('lib/session.php');

$addressCheck = $_POST['address'];
$houseNameCheck = $_POST['house'];

$sql = "SELECT * FROM houseName WHERE address = '{$addressCheck}'";

$res = $conn->query($sql);

// 건물 목록에 등록된 주소라면
if($res->num_rows >= 1){
// 등록된 이름인지 확인
  $sql_houseName = "SELECT * FROM houseName WHERE houseName = '{$houseNameCheck}'";
  $res_houseName = $conn->query($sql_houseName);
  //등록된 이름이라면
  if($res_houseName->num_rows >= 1 && ($_POST['rent'] || $_POST['review'])){
    $row_houseName = mysqli_fetch_array($res_houseName);
  // data 테이블에 저장
    $sql = "INSERT INTO data
          (houseName_id,
          rent,
          review,
          created,
          memberId)
            VALUES(
                '{$row_houseName['id']}',
                '{$_POST['rent']}',
                '{$_POST['review']}',
                NOW(),
                '{$_SESSION['ses_userid']}'
            )
        ";
    $result = mysqli_query($conn, $sql);
    if($result === false){
      echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요. <a href="addInfo.php">돌아가기</a>';
      // echo(mysqli_error($conn));
    } else {
      header('Location: index.php');
    }

  } else if($_POST['rent'] || $_POST['review']){ //등록된 주소인데 등록된 이름이 아니라면
    echo '이미 등록된 건물주소입니다. 관리자에게 문의해주세요. <a href="addInfo.php">돌아가기</a>';
  } else { //임대료와 한줄평을 작성하지 않은 경우
    header('Location: index.php');
  }


// 건물목록에 없는 주소라면 건물목록에 저장하고 data테이블에 저장
} else {

  $sql_houseName = "SELECT * FROM houseName WHERE houseName = '{$houseNameCheck}'";
  $res_houseName = $conn->query($sql_houseName);
  //등록된 이름이라면
  if($res_houseName->num_rows >= 1){
    echo '동일한 건물명이 다른 주소에 등록되어있습니다. 관리자에게 문의해주세요. <a href="addInfo.php">돌아가기</a>';
  } else {
    $sql = "INSERT INTO houseName
          (houseName,
          address,
          created,
          updater)
            VALUES(
                '{$_POST['house']}',
                '{$_POST['address']}',
                NOW(),
                '{$_SESSION['ses_userid']}'
            )
        ";

    $result = mysqli_query($conn, $sql);

    if($result === false){
      echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요. <a href="addInfo.php">돌아가기</a>';
      // echo(mysqli_error($conn));
    } else if($_POST['rent'] || $_POST['review']){
      $sql = "SELECT id FROM houseName WHERE address = '{$addressCheck}'";
      $res = $conn->query($sql);
      $row = mysqli_fetch_array($res);

      $sql = "INSERT INTO data
            (houseName_id,
            rent,
            review,
            created,
            memberId)
              VALUES(
                  '{$row['id']}',
                  '{$_POST['rent']}',
                  '{$_POST['review']}',
                  NOW(),
                  '{$_SESSION['ses_userid']}'
              )
          ";

      $result = mysqli_query($conn, $sql);

      if($result === false){
        echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요. <a href="addInfo.php">돌아가기</a>';
        // echo(mysqli_error($conn));
      } else {
        header('Location: index.php');
      }
    } else {
      header('Location: index.php');
    }
  }


}



?>
