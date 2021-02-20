<?php
    require('lib/session.php');
    require('lib/conn.php');

    $memberId = $_POST['memberId'];
    $memberPw = $_POST['memberPw'];

    $sql = "SELECT * FROM member WHERE memberId = '{$memberId}'";
    $res = $conn->query($sql);
    $row = $res->fetch_array(MYSQLI_ASSOC);

    $id = $row['memberId'];
    $pw = $row['password'];
    $nick = $row['nickname'];

    if ($row != null) {
        if ( password_verify($memberPw, $pw)) {
            //success
            $_SESSION['ses_userid'] = $row['memberId'];
            $_SESSION['ses_nick'] = $row['nickname'];
            header ('Location: index.php');
            } else {
                //fail
                echo '로그인 실패 : 아이디 또는 비밀번호가 일치하지 않습니다.';
                echo '<a href="signInForm.php">돌아가기</a>';
            }
       }

    if($row == null){
        echo '로그인 실패 : 아이디 또는 비밀번호가 일치하지 않습니다.';
        echo '<a href="signInForm.php">돌아가기</a>';
        }
?>
