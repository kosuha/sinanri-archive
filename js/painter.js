$(document).ready(function() {

  var drawCanvas = document.getElementById('drawCanvas');

  var drawBackup = new Array();

  if (typeof drawCanvas.getContext == 'function') {

    var ctx = drawCanvas.getContext('2d');

    var isDraw = false;

    var width = $('#width').val();;

    var color = $('#color').val();

    var pDraw = $('#drawCanvas').offset();

    var currP = null;



    $('#width').bind('change', function() {
      width = $('#width').val();
    });

    $('td').click(function () {
      var tdname = $(this).attr("name");
      $('#color').css("background-color", tdname);
      $('#color').attr("name", tdname);
      color = $('#color').attr("name");
    });


    // Event (마우스)

    $('#drawCanvas').bind('mousedown', function(e) {

      if (e.button === 0) {

        saveCanvas();

        e.preventDefault();

        ctx.beginPath();

        isDraw = true;

      }

    });

    $('#drawCanvas').bind('mousemove', function(e) {

      var event = e.originalEvent;

      e.preventDefault();

      currP = {
        X: event.offsetX,
        Y: event.offsetY
      };

      if (isDraw) draw_line(currP);

    });

    $('#drawCanvas').bind('mouseup', function(e) {

      e.preventDefault();

      isDraw = false;

    });

    $('#drawCanvas').bind('mouseleave', function(e) {

      isDraw = false;

    });



    // Event (터치스크린)

    $('#drawCanvas').bind('touchstart', function(e) {

      saveCanvas();

      e.preventDefault();

      ctx.beginPath();

    });

    $('#drawCanvas').bind('touchmove', function(e) {

      var event = e.originalEvent;

      e.preventDefault();

      currP = {
        X: event.touches[0].pageX - pDraw.left,
        Y: event.touches[0].pageY - pDraw.top
      };

      draw_line(currP);

    });

    $('#drawCanvas').bind('touchend', function(e) {

      e.preventDefault();

    });



    // 선 그리기

    function draw_line(p) {

      ctx.lineWidth = width;

      ctx.lineCap = 'round';

      ctx.lineTo(p.X, p.Y);

      ctx.moveTo(p.X, p.Y);

      ctx.strokeStyle = color;

      ctx.stroke();

    }


    function saveImage() {
      var selectHouse = $('.selectBox option:selected').val();
      var canvasData = drawCanvas.toDataURL();

      if (selectHouse == '') {
        alert('건물명을 선택해주세요.');
        return false;
      }

      $.ajax({
        type: 'post',
        url: '../canvasDataSave.php',
        data: {
          canvasData: canvasData,
          selectHouse: selectHouse
        },
        success: function() {
          location.reload();
        },
        error: function() {
          alert('오류: 관리자에게 문의하세요.');
        }
      });
    }



    function clearCanvas() {

      ctx.clearRect(0, 0, drawCanvas.width, drawCanvas.height);

      ctx.beginPath();

      // localStorage.removeItem('imgCanvas');

    }



    function saveCanvas() {

      drawBackup.push(ctx.getImageData(0, 0, drawCanvas.width, drawCanvas.height));

    }

    function prevCanvas() {

      ctx.putImageData(drawBackup.pop(), 0, 0);

    }

    $('.selectBox').change(function() {
      var imgClo = new Image(); //이미지 객체 생성
      var selectHouse = $('.selectBox option:selected').val();
      clearCanvas();
      if (selectHouse != '') {
        $.ajax({
          type: 'post',
          dataType: 'json',
          url: '../loadOnCanvas.php',
          data: {
            selectHouse: selectHouse
          },
          success: function(json) {
            var imgLoad = json.res;
            imgClo.src = imgLoad;
            //drawImage() 함수를 사용하여 이미지 출력
            ctx.drawImage(imgClo, 0, 0);
          }
          // error: function() {
          //   alert('오류: 관리자에게 문의하세요.');
          // }
        });
      }

    });

    $('#btnPrev').click(function() {

      prevCanvas();

    });



    $('#btnClea').click(function() {

      clearCanvas();

    });



    $('#btnSave').click(function() {

      saveImage();

    });

  }

});

$(document).ready(function(){
  $('.showButton').hide();
});

$('.hideButton').click(function(){
  $('.painter').hide();
  map.relayout();
  $('.showButton').show();
});

$('.showButton').click(function(){
  $('.painter').show();
  map.relayout();
  $('.showButton').hide();
});

$(window).resize(function(){
  map.relayout();
});