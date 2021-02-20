<?php
require('lib/conn.php');
require('lib/session.php');

$sql = "INSERT INTO generalForum
      (post,
      postedTime,
      nickname,
      memberId)
        VALUES(
            '{$_POST['post']}',
            NOW(),
            '{$_SESSION['ses_nick']}',
            '{$_SESSION['ses_userid']}'
        )
    ";

$result = mysqli_query($conn, $sql);

if($result === false){
  echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요. <a href="forum.php">돌아가기</a>';
  // echo(mysqli_error($conn));
} else {
  header('Location: forum.php');
}

?>
