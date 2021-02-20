<!doctype html>
<html>
<head>
  <?php require('lib/metaTag.php'); ?>
  <script type="text/javascript" src="js/mySignInForm.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.9.0/p5.js"></script>
  <script src="./sketch.js"></script>
  <script src="./boundary.js"></script>
  <script src="./ray.js"></script>
  <script src="./particle.js"></script>
  <link rel="stylesheet" href="css/signInForm.css">
  <?php require('lib/jquerys.php'); ?>
  <?php require('lib/title.php'); ?>
</head>
<body>
<div class="indexcnv" id="sketch-holder"></div>
<div id="wrap">
    <table id="container">
      <form name="singIn" action="./signIn.php" method="post" onsubmit="return checkSubmit()">
      <tr>
        <td colspan="2">
          <h1 class="title">Sinanri Archive</h1>
        </td>
      </tr>
        <tr>
          <td id="ID">ID</td>
          <td>
            <div class="inputArea">
              <input type="text" name="memberId" class="memberId" />
            </div>
          </td>
        </tr>
        <tr>
          <td id="PW">PW</td>
          <td>
            <div class="inputArea">
                <input type="password" name="memberPw" class="memberPw" />
            </div>
          </td>
        </tr>
      <tr>
        <td id="buttons" colspan="2">
          <div class="line">
            <a href="signUpForm.php">회원가입</a>
            <input type="submit" value="로그인" class="submit" />
          </div>
        </td>
      </tr>
      </form>
    </table>
</div>
</body>
</html>
