<?php require('lib/session.php'); ?>
<?php require('lib/sessionCheck.php'); ?>

<!DOCTYPE html>
<html>

<head>
  <?php require('lib/metaTag.php'); ?>
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="css/nav.css">
  <?php require('lib/jquerys.php'); ?>
  <title>Sinanri Archive</title>
</head>

<body>
  <main id="map">
    <div id="kakaomap" style="width:500px; height:400px;">

    </div>
  </main>
  <aside id="basicInfo">
    <div class="info_contents">
      <h1>Sinanri Archive</h1>
      <p>
        <h3><?php echo $_SESSION['ses_nick']; ?>님 안녕하세요.</h3>
      </p>
    </div>
    <input type="button" id="button_infoOnOff" value=">">
  </aside>
  <?php require('lib/nav.php'); ?>
  <script>
    function fetchPage(name) {
      fetch(name).then(function(response) {
        response.text().then(function(text) {
          document.querySelector('.info_contents').innerHTML = text;
        })
      });
    }

    fetch('map.php').then(function(response) {
      response.text().then(function(text) {
        var items = text.split(',');
        var i = 0;
        var tags = '';

        while (i < items.length) {
          var item = items[i];
          item = item.trim();
          var tag = '<p id="house_' + i + '"><a href="#!' + i + '" onclick="fetchPage(\'data/' + i + '.php\')"><img src="image/test-img.svg">' + item + '</a></p>';
          tags = tags + tag;
          i = i + 1;
        }
        $('#map').html(tags);
      });
    });
  </script>
  <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=70d9a9623e473ec0d2a68f47b93e0a7f"></script>
  <script type="text/javascript" src="js/home.js"></script>
  <script type="text/javascript" src="js/kakaomap.js"></script>
</body>

</html>
