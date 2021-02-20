<?php

    require('lib/conn.php');

    $houseCheck = $_POST['houseCheck'];

    $sql = "SELECT * FROM houseName WHERE houseName = '{$houseCheck}'";

    $res = $conn->query($sql);
    $row = mysqli_fetch_array($res);


    if($res->num_rows >= 1){
        echo json_encode(array('res'=>$row['address']));
    }else{
        echo json_encode(array('res'=>'건물명을 선택해주세요.'));
    }

?>
