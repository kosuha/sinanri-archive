<!DOCTYPE html>
<html>

<head>
  <?php require('lib/metaTag.php'); ?>
  <link rel="stylesheet" href="css/addInfo.css">
  <link rel="stylesheet" href="css/nav.css">
  <?php require('lib/jquerys.php'); ?>
  <?php require('lib/title.php'); ?>
</head>

<body>
    <div id="container">
    <?php require('lib/nav.php'); ?>
    <div class="bodyWrap">
      <div class="showButton">열기</div>
      <main>
        <div class="hideButton">접기</div>
        <form class="" action="createData_process.php" method="post" autocomplete="off" onsubmit="return checkAddInfo()">
          <table>
          <tr>
            <td>
            <h4>
            찾는 건물이 리스트에 없다면 <br>
            '아카이빙 되지 않은 건물'을 선택 후 건물명을 입력하고 <br>
            해당 건물의 주소를 입력해주세요.<br><br>
            도로명주소를 직접 입력 시 <br>
            '세종특별자치시 조치원읍 섭골길 12-3'과 <br>
            같은 형식을 지켜야 합니다.<br><br>
            지번주소는 지원하지 않습니다.<br><br>
            지도에서 건물을 클릭하면 주소가 자동으로 입력됩니다.<br><br>
            제대로 된 도로명주소를 입력했다면 주소 클릭 시 <br>
            지도 가운데에 해당 주소가 위치합니다.<br>
            </h4>
            </td>
          </tr>
            <tr>
              <td>
                <h3>건물명(등록된 건물인지 확인해주세요)</h3>
                <select class="selectBox" name="">
                  <option value="">선택</option>
                  <option value="1">아카이빙 되지 않은 건물</option>
                  <?php require('lib/houseList_addInfo.php'); ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>
                <input class="house" type="text" name="" value="" placeholder="건물명을 입력해주세요.">
              </td>
            </tr>
            <tr>
              <td>
                <h3>도로명 주소(필수)</h3>
                <input class="address" type="text" name="address" value="">
                <div id="addrComment">
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <h3>정보</h3>
                <textarea class="review" name="review" id="review" placeholder="정보를 입력해주세요."></textarea>
                <div id="counter">(0 / 100자)</div>
              </td>
            </tr>
            <tr class="trButton">
              <td>
                <input class="button" type="submit">
              </td>
            </tr>
          </table>
        </form>
      </main>
      <aside id="map">&nbsp;</aside>
    </div>
  </div>
  <script type="text/javascript">
    <?php require('houseMarker.php'); ?>
  </script>
  
  <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=70d9a9623e473ec0d2a68f47b93e0a7f&libraries=services"></script>
  <script type="text/javascript" src="js/kakaomap_addInfo.js"></script>
  <script src="js/addInfo.js"></script>
</body>

</html>
