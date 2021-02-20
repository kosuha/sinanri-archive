<?php
    require('lib/conn.php');

    $memberId = $_POST['memberId'];
    $memberName = $_POST['memberName'];
    $memberPw = $_POST['memberPw'];
    $memberPw2 = $_POST['memberPw2'];
    $memberNickName = $_POST['memberNickName'];
    $memberEmailAddress = $_POST['memberEmailAddress'];

    //PHP에서 유효성 재확인

    //아이디 중복검사.
    $sql = "SELECT * FROM member WHERE memberId = '{$memberId}'";
    $res = $conn->query($sql);
    if($res->num_rows >= 1){
        echo '이미 존재하는 아이디가 있습니다.';
        echo '<a href="signUpForm.php">돌아가기</a>';
    }

    //비밀번호 일치하는지 확인
    if($memberPw !== $memberPw2){
        echo '비밀번호가 일치하지 않습니다.';
        echo '<a href="signUpForm.php">돌아가기</a>';
    }

    //닉네임 그리고 이름이 빈값이 아닌지
    if($memberNickName == '' || $memberName == ''){
        echo '이름 혹은 닉네임의 값이 없습니다.';
        echo '<a href="signUpForm.php">돌아가기</a>';
    }

    //이메일 주소가 올바른지
    $checkEmailAddress = filter_var($memberEmailAddress, FILTER_VALIDATE_EMAIL);

    if($checkEmailAddress != true){
        echo "올바른 이메일 주소가 아닙니다.";
        echo '<a href="signUpForm.php">돌아가기</a>';
    }

    if($res->num_rows === 0 && $memberPw === $memberPw2 && $memberNickName != '' && $memberName != '' && $checkEmailAddress == true){
        //비밀번호를 암호화 처리.
        $password = password_hash($memberPw, PASSWORD_DEFAULT, array('cost' => 12));
        //이제부터 넣기 시작
        $sql = "INSERT INTO member VALUES('','{$memberId}','{$memberName}','{$memberNickName}','{$password}','{$memberEmailAddress}',NOW());";
        if($conn->query($sql)){
            echo '회원가입이 완료되었습니다.';
            echo '<a href="index.php">메인페이지로 이동하기</a>';
        }
    }
    

    
?>
