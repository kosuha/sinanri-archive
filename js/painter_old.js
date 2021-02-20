var DrawingTool = {
  canvas: null,
  context: null,
  drawX: [],
  drawY: [],
  drawDrag: [],
  drawColor: [],
  isDraw: false,
  colorTable: [
    "rgb(0, 0, 0)",
    "rgb(118, 53, 0)",
    "rgb(255, 0, 0)",
    "rgb(255, 127, 0)",
    "rgb(255, 255, 0)",
    "rgb(0, 255, 0)",
    "rgb(0, 0, 255)",
    "rgb(0, 0, 123)",
    "rgb(255, 0, 255)"
  ]
};

DrawingTool.init = function() {
  var self = this;
  var offset = $("#canvas").offset();
  this.canvas = document.getElementById("canvas");
  this.context = this.canvas.getContext("2d");

  $("#canvas").mousedown(function(event) {
    self.isDraw = true;
    self.addDraw(event.pageX - offset.left, event.pageY - offset.top);
    self.reDraw();
  });

  $("#canvas").mousemove(function(event) {
    if (self.isDraw) {
      self.addDraw(event.pageX - offset.left, event.pageY - offset.top, true);
      self.reDraw();
    }
  });

  $("#canvas").bind("mouseup mouseleave", function(event) {
    self.isDraw = false;
  });

  this.setColorButton();
  this.setResetButton();
};

DrawingTool.addDraw = function(x, y, drawing) {
  this.drawX.push(x);
  this.drawY.push(y);
  this.drawDrag.push(drawing);
  this.drawColor.push(this.selectedColor || this.colorTable[0]);
};

DrawingTool.reDraw = function() {
  this.context.lineJoin = "round";
  this.context.lineWidth = 5;

  for (var i = 0; i < this.drawX.length; i++) {
    this.context.beginPath();
    if (this.drawDrag[i] && i) {
      this.context.moveTo(this.drawX[i - 1], this.drawY[i - 1]);
    } else {
      this.context.moveTo(this.drawX[i] - 1, this.drawY[i]);
    }

    this.context.lineTo(this.drawX[i], this.drawY[i]);
    this.context.closePath();
    this.context.strokeStyle = this.drawColor[i];
    this.context.stroke();
  }
};

DrawingTool.setColorButton = function() {
  var self = this;
  $("#color > button").on("click", function(event) {
    self.selectedColor = self.colorTable[$(this).index()];
  });
};

DrawingTool.setResetButton = function() {
  var self = this;
  $("#reset").on("click", function(event) {
    self.canvas.width = self.canvas.width;
    self.drawX = [], self.drawY = [], self.drawDrag = [], self.drawColor = [];
  });
};

$('.selectBox').change(function() {
  //이미지 객체 생성
  var imgClo = new Image();
  var canvas = document.getElementById('canvas');
  var ctx = canvas.getContext("2d");
  var selectHouse = $('.selectBox option:selected').val();
  //canvas 비우기
  var self = DrawingTool;
  self.canvas.width = self.canvas.width;
  self.drawX = [], self.drawY = [], self.drawDrag = [], self.drawColor = [];

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
        //canvas.drawImage() 함수를 사용하여 이미지 출력
        ctx.drawImage(imgClo, 0, 0);
      },
      // error: function() {
      //   alert('오류: 관리자에게 문의하세요.');
      // }
    });
  }
});

// 버튼을 클릭할 경우
$("#save").click(function() {
  var selectHouse = $('.selectBox option:selected').val();
  var canvasData = document.getElementById('canvas').toDataURL();

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
});

DrawingTool.init();
