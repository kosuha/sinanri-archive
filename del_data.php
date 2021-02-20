<?php
  require('lib/session.php');
  require('lib/sessionCheck.php');
  require('lib/conn.php');

  $memberId = $_SESSION['ses_userid'];
//   $v = $_POST['v'];

  settype($_POST['v'], 'integer');
  $filtered = array(
      'v'=>mysqli_real_escape_string($conn, $_POST['v'])
  );

  $sql = "DELETE FROM data WHERE id = '{$filtered['v']}'";

  $res = $conn->query($sql);

    if($res->num_rows >= 1){
        echo json_encode(array('res'=>'bad'));
    }else{
        echo json_encode(array('res'=>$filtered['v']));
    }
?>
