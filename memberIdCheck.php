<?php

    require('lib/conn.php');

    $memberId = $_POST['memberId'];

    $sql = "SELECT * FROM member WHERE memberId = '{$memberId}'";

    $res = $conn->query($sql);


    if($res->num_rows >= 1){
        echo json_encode(array('res'=>'bad'));
    }else{
        echo json_encode(array('res'=>'good'));
    }

?>
