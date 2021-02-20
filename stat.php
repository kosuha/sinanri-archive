<?php
  require('lib/conn.php');
  require('lib/session.php');
  require('lib/sessionCheck.php');

  $sql_rent_avg = "SELECT ROUND(AVG(rent),1) FROM data WHERE rent != 0";
  $sql_rent_min = "SELECT MIN(rent) FROM data WHERE rent != 0";
  $sql_rent_max = "SELECT MAX(rent) FROM data WHERE rent != 0";

  $result_rent_avg = mysqli_query($conn, $sql_rent_avg);
  $rent_avg = mysqli_fetch_array($result_rent_avg);
  $result_rent_min = mysqli_query($conn, $sql_rent_min);
  $rent_min = mysqli_fetch_array($result_rent_min);
  $result_rent_max = mysqli_query($conn, $sql_rent_max);
  $rent_max = mysqli_fetch_array($result_rent_max);

?>

<!DOCTYPE html>
<html>
  <head>
    <?php require('lib/metaTag.php'); ?>
    <link rel="stylesheet" href="css/stat.css">
    <link rel="stylesheet" href="css/nav.css">
    <?php require('lib/jquerys.php'); ?>
    <?php require('lib/title.php'); ?>
  </head>
  <body>
    <?php require('lib/nav.php'); ?>
    <main>
      <div class="mainWrap">
        <article class="">
          <h2>전체 평균</h2>
          <?php
            echo "<p>$rent_avg[0] 만원</p>"
          ?>
        </article>
        <article class="">
          <h2>최고 가격</h2>
          <?php
            echo "<p>$rent_max[0] 만원</p>"
          ?>
        </article>
        <article class="">
          <h2>최저 가격</h2>
          <?php
            echo "<p>$rent_min[0] 만원</p>"
          ?>
        </article>
      </div>
    </main>
    <script src="js/nav.js"></script>
  </body>
</html>
