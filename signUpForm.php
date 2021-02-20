<!doctype html>
<html>
<head>
  <?php require('lib/metaTag.php'); ?>
  <link rel="stylesheet" href="css/signUpForm.css">
  <?php require('lib/jquerys.php'); ?>
  <?php require('lib/title.php'); ?>
</head>
<body>
<form name="signUp" action="memberSave.php" method="post">
<table>
  <tr>
    <td colspan="2">
      <h1 class="title">회원가입</h1>
    </td>
  </tr>
  <tr>
    <td>아이디</td>
    <td>
      <div class="inputArea">
        <input type="text" name="memberId" class="memberId" maxlength="20" style="ime-mode:inactive;"/>
      </div>
    </td>
    <td class="tdCheck">
      <div class="memberIdComment comment"></div>
    </td>
  </tr>
  <tr>
    <td>이름</td>
    <td>
      <div class="inputArea">
          <input type="text" name="memberName" class="memberName" style="ime-mode:active;"/>
      </div>
    </td>
  </tr>
  <tr>
    <td>비밀번호</td>
    <td>
      <div class="inputArea">
          <input type="password" name="memberPw" class="memberPw"/>
      </div>
    </td>
  </tr>
  <tr>
    <td>비밀번호 확인</td>
    <td>
      <div class="inputArea">
          <input type="password" name="memberPw2" class="memberPw2"/>
      </div>
    </td>
    <td class="tdCheck">
      <div class="memberPw2Comment comment"></div>
    </td>
  </tr>
  <tr>
    <td>닉네임</td>
    <td>
      <div class="inputArea">
        <input type="text" name="memberNickName" class="memberNickName" maxlength="20"/>
      </div>
    </td>
    <td class="tdCheck">
      <div class="memberNickNameComment comment"></div>
    </td>
  </tr>
  <tr>
    <td>이메일</td>
    <td>
      <div class="inputArea">
          <input type="text" name="memberEmailAddress" class="memberEmailAddress" />
      </div>
    </td>
    <td class="tdCheck">
      <div class="memberEmailAddressComment comment"></div>
    </td>
  </tr>
  <tr>
    <td colspan="2">
      <input id="submit" type="submit" value="가입하기" class="submit"/>
    </td>
  </tr>
</table>
</form>
<script type="text/javascript" src="js/mySignUpForm.js"></script>
</body>
</html>
