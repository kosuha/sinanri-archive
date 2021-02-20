<?php require('lib/session.php'); ?>
<?php require('lib/sessionCheck.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <?php require('lib/metaTag.php'); ?>
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="css/nav.css">
  <?php require('lib/jquerys.php'); ?>
  <?php require('lib/title.php'); ?>
</head>
<body>
  <div class="bodyContainer">
    <?php require('lib/nav.php'); ?>
    <div class="bodyWrap">
      <main id="map">&nbsp;</main>
      <aside id="basicInfo">
        <div class="info_contents">
          <div class="info_side">
            <h1 class="clickedHouseName">Sinanri Archive</h1>
            <h3 class="addr"><?php echo $_SESSION['ses_nick']; ?>님 안녕하세요.<br>
            신안리 아카이브는 지도를 기반으로 신안리의 정보를 수집하고 공유하는 플랫폼입니다.</h3>
            <!-- <h3 class="average"></h3> -->
          </div>
          <div class="review5"></div>
        </div>
      </aside>
    </div>
  </div>
  <script type="text/javascript">
    <?php require('houseMarker.php'); ?>
  </script>
  <script type="text/javascript" src="js/home.js"></script>
  <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=70d9a9623e473ec0d2a68f47b93e0a7f&libraries=services"></script>
  <script type="text/javascript" src="js/kakaomap.js"></script>
</body>

</html>
