<?php require('lib/session.php'); ?>
<?php require('lib/sessionCheck.php'); ?>

<!DOCTYPE html>
<html>

<head>
  <?php require('lib/metaTag.php'); ?>
  <link rel="stylesheet" href="css/nav.css">
  <link rel="stylesheet" href="css/forum.css">
  <?php require('lib/jquerys.php'); ?>
  <?php require('lib/title.php'); ?>
</head>

<body>
  <?php require('lib/nav.php'); ?>
  <main>
    <div class="mainWrap">
      <div class="noticeArea">
        <h1>Notice</h1>
        <article class="notice">
          <div>
            <h3>안녕하세요</h3>
            <p>
              신안리 아카이브는 지도를 기반으로 신안리의 정보를 수집하고 공유하는 플랫폼입니다.
            </p>
          </div>
        </article>
      </div>
      <div class="forumArea">
        <h1>Forum</h1>
        <form action="createPost_process.php" method="POST">
          <table id="postWrite">
            <tr>
              <td colspan="2"><textarea name="post" id="post" placeholder="게시글 내용을 입력하세요."></textarea></td>
            </tr>
            <tr>
              <td id="counter">0/300</td>
              <td id="sub"><input type="submit" value="OK"></td>
            </tr>
          </table>
        </form>
        <article class="forum_general">
        </article>
        <div class="more">
          more
        </div>
      </div>
      <div class="infoArea">
        <h1>Info</h1>
        <select class="selectBox" name="">
          <option value="a">건물선택</option>
          <?php require('lib/houseList_addInfo.php'); ?>
        </select>
        <article class="data_general">
        </article>
      </div>
    </div>
  </main>
  <script type="text/javascript" src="js/forum.js"></script>
</body>

</html>
