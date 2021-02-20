<?php

    require('lib/conn.php');

    $addressCheck = $_POST['addressCheck'];

    $sql = "SELECT * FROM houseName WHERE address = '{$addressCheck}'";

    $res = $conn->query($sql);

    if($res->num_rows >= 1){
        echo json_encode(array('res'=>'bad'));
    }else{
        echo json_encode(array('res'=>'good'));
    }

?>
