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
      <div class="showButton">열기</div>
      <div class="painter">
        <div class="hideButton">접기</div>
        <div id="selectHouse">
          <h3>건물명</h3>
          <select class="selectBox" name="">
            <option value="">건물선택</option>
            <?php require('lib/houseList_addInfo.php'); ?>
          </select>
        </div>
        <div id="canvasContainer">
          <h3 id="canvasTitle">캔버스</h3>
          <canvas id="drawCanvas" width="300px" height="300px"></canvas>
        </div>
        <div id="toolsContainer">
        <div id="tools">
          <select id="width">
      			<option value="1">1px</option>
      			<option value="2">2px</option>
      			<option value="3" selected>3px</option>
      			<option value="5">5px</option>
      			<option value="10">10px</option>
      			<option value="20">20px</option>
      		</select>
          <div class="color">
              <table>
                <tr>
                  <td rowspan="2" id="color" name="#000000">&nbsp;</td>
                  <td id="color_1" name="#FF0000">&nbsp;</td>
                  <td id="color_9" name="#F7931E">&nbsp;</td>
                  <td id="color_2" name="#FFFF00">&nbsp;</td>
                  <td id="color_3" name="#00FF00">&nbsp;</td>
                  <td id="color_4" name="#00FFFF">&nbsp;</td>
                </tr>
                <tr>
                  <td id="color_5" name="#0000FF">&nbsp;</td>
                  <td id="color_6" name="#FF00FF">&nbsp;</td>
                  <td id="color_7" name="#603813">&nbsp;</td>
                  <td id="color_8" name="#FFFFFF">&nbsp;</td>
                  <td id="color_10" name="#000000">&nbsp;</td>
                </tr>
              </table>
          </div>
        </div>
        <div class="btns">
          <button id="btnSave">저장</button>
          <button id="btnPrev">되돌리기</button>
      		<button id="btnClea">리셋</button>
        </div>
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
