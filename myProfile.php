<?php
  require('lib/session.php');
  require('lib/sessionCheck.php');
  require('lib/conn.php');

  $memberId = $_SESSION['ses_userid'];
  $memberNick = $_SESSION['ses_nick'];

//등록된 post를 $list 배열에 저장
  $sql = "SELECT * FROM member WHERE memberId = '{$memberId}'";

  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);

    echo "<div>
          <p class=\"ID\">$memberId</p>
          <p class=\"name\">$row[2]</p>
          <p class=\"nick\">$memberNick</p>
          <p class=\"email\">$row[5]</p>
          <p class=\"created\">$row[6]</p>
          </div>
          ";
?>
