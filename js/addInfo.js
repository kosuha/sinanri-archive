function checkAddInfo() {
  if ($('.selectBox option:selected').val() == '') {
    alert('건물명을 선택해주세요.');
    return false;
  }

  if ($('.selectBox option:selected').val() == '1') {
    if ($('.house').val() == '') {
      alert('건물명을 선택해주세요.');
      return false;
    }
  }

  if ($('.address').val() == '') {
    alert('도로명 주소를 입력해주세요.');
    return false;
  }

  // if ($('.rent').val() == '') {
  //   alert('임대료를 입력해주세요.');
  //   return false;
  // }
  //
  // if ($('.review').val() == '') {
  //   alert('한줄평을 입력해주세요.');
  //   return false;
  // }

  if (checkAddressSubmit == false) {
    alert('유효한 주소를 입력해주세요.');
    return false;
  }

  return true;
}

$('#review').keyup(function() {
  var content = $(this).val();
  $('#counter').html("(" + content.length + " / 100자)"); //글자수 실시간 카운팅

  if (content.length > 100) {
    $(this).val(content.substring(0, 100));
    $('#counter').html("(100 / 100자)");
  }
});

$('.house').css('display', 'none');

$('.selectBox').change(function() {

  var selectBox = $('.selectBox option:selected').val();
  if (selectBox != '1') {
    $('.house').css('display', 'none');
    $('.selectBox').attr('name', 'house');
  }
  if (selectBox == '1') {
    $('.house').css('display', '');
    $('.house').attr('name', 'house');
  }

  $.ajax({
    type: 'post',
    dataType: 'json',
    url: '../houseCheck.php',
    data: {
      houseCheck: selectBox
    },
    success: function(json) {
      var result = json.res;
      if (selectBox != null && selectBox != 1) {
        $('.address').val(null);
        $('.address').val(result);
        $('.address').attr("readonly", true);
      } else {
        $('#addrComment').html('');
        $('.address').attr("readonly", false);
      }
    },
    error: function() {
      alert('오류: 관리자에게 문의하세요.');
    }
  });
});

$(document).ready(function(){
  $('.showButton').hide();
});

$('.hideButton').click(function(){
  $('main').hide();
  map.relayout();
  $('.showButton').show();
});

$('.showButton').click(function(){
  $('main').show();
  map.relayout();
  $('.showButton').hide();
});

$(window).resize(function(){
  map.relayout();
});