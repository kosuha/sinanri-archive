<?php

    require('lib/conn.php');

    //ajax로 주소 받아옴
    $markerClicked = $_POST['markerClicked'];

    //해당하는 원룸 이름 가져오기
      $sql = "SELECT id, houseName FROM houseName WHERE address='{$markerClicked}'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result);
      $clickedHouseId = $row[0];
      $clickedHouseName = $row[1];

    //해당하는 원룸의 임대료 평균값 데이터베이스에서 가져오기
      $avg_sql = "SELECT ROUND(AVG(rent),1) FROM data WHERE houseName_id='{$clickedHouseId}' AND rent != 0";
      $avg_result = mysqli_query($conn, $avg_sql);
      $avg = mysqli_fetch_array($avg_result);
      $average = $avg[0];

    //해당하는 원룸의 최근 한줄평을 5개까지 보여주기
      $review_sql = "SELECT review FROM data WHERE houseName_id='{$clickedHouseId}' AND CHAR_LENGTH(review) > 0 ORDER BY id DESC LIMIT 5";
      $review_result = mysqli_query($conn, $review_sql);
      $review_list = '';
      while ($review_array = mysqli_fetch_array($review_result)) {
        $review_list = $review_list."<li>{$review_array[0]}</li>";
      }
      $review5 = "<ul>".$review_list."</ul>";

      echo json_encode(array(
        'res_clickedHouseName'=>$clickedHouseName,
        'res_average'=>$average,
        'res_review5'=>$review5
      ));
?>
