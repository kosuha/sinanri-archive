<?php
  require('lib/session.php');
  require('lib/sessionCheck.php');
?>

<!DOCTYPE html>
<html>

<head>
  <?php require('lib/metaTag.php'); ?>
  <link rel="stylesheet" href="css/myPage.css">
  <link rel="stylesheet" href="css/nav.css">
  <?php require('lib/jquerys.php'); ?>
  <?php require('lib/title.php'); ?>
</head>

<body>
  <div class="container">
    <?php require('lib/nav.php'); ?>
    <div class="bodyWrap">
      <div class="_myProfile">
        <div class="_myProfile_top">
          <h3>프로필</h3>
          <a href="signOut.php">LOGOUT</a>
        </div>
        <div class="myProfile"></div>
      </div>
      <div class="_myData">
        <h3>내가 공유한 정보</h3>
        <div class="myData"></div>
      </div>
      <div class="_myPost">
        <h3>내가 쓴 게시글</h3>
        <div class="myPost"></div>
        <div class="myPostMore">
          more
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    fetch('myProfile.php').then(function(response) {
      response.text().then(function(text) {
        document.querySelector('.myProfile').innerHTML = text;
      })
    });
    // fetch('myPostList.php').then(function(response) {
    //   response.text().then(function(text) {
    //     document.querySelector('.myPost').innerHTML = text;
    //   })
    // });
    fetch('myDataList.php').then(function(response) {
      response.text().then(function(text) {
        document.querySelector('.myData').innerHTML = text;
      })
    });
  </script>
  <script src="js/myPage.js"></script>
</body>

</html>
