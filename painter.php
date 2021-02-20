<?php require('lib/session.php'); ?>
<?php require('lib/sessionCheck.php'); ?>

<!DOCTYPE html>
<html>

<head>
  <?php require('lib/metaTag.php'); ?>
  <link rel="stylesheet" href="css/painter.css">
  <link rel="stylesheet" href="css/nav.css">
  <?php require('lib/jquerys.php'); ?>
  <?php require('lib/title.php'); ?>
</head>

<body>
  <div class="container">
    <?php require('lib/nav.php'); ?>
    <div class="bodyWrap">
      <div class="painter">
        <div id="selectHouse">
          <h3>건물명</h3>
          <select class="selectBox" name="">
            <option value="">선택</option>
            <?php require('lib/houseList_addInfo.php'); ?>
          </select>
        </div>
        <div id="canvasContainer">
          <canvas id="drawCanvas" width="300px" height="300px"></canvas>
        </div>
        <div id="tools">
          <select id="width">
      			<option value="1">1px</option>
      			<option value="2">2px</option>
      			<option value="3" selected>3px</option>
      			<option value="5">5px</option>
      			<option value="10">10px</option>
      			<option value="20">20px</option>
      		</select>
      		<select id="color">
      			<option value="#000000">검정</option>
      			<option value="#FF0000">빨강</option>
      			<option value="#00FF00">녹색</option>
      			<option value="#0000FF">파랑</option>
      			<option value="#FFFF00">노랑</option>
      			<option value="#FFFFFF">흰색</option>
      		</select>
        </div>
        <div class="btns">
          <button id="btnSave">저장</button>
          <button id="btnPrev">되돌리기</button>
      		<button id="btnClea">리셋</button>
        </div>
      </div>
      <div id="map">&nbsp;</div>
    </div>
  </div>
  <script type="text/javascript">
    <?php require('canvasDataLoad.php'); ?>
  </script>
  <script type="text/javascript" src="js/painter.js"></script>
  <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=70d9a9623e473ec0d2a68f47b93e0a7f&libraries=services"></script>
  <script type="text/javascript" src="js/kakaomap_draw.js"></script>
  <script type="text/javascript" src="js/road.js"></script>
</body>

</html>
