$('#post').keyup(function() {
  var content = $(this).val();
  $('#counter').html(content.length + "/300"); //글자수 실시간 카운팅

  if (content.length > 300) {
    $(this).val(content.substring(0, 300));
    $('#counter').html("300/300");
  }
});

var lastSeq = 0;  //마지막 게시물 번호
var showNum = 7;  //보여지는 게시물 갯수 단위

$(document).ready(function() {
  $.ajax({
    type: 'post',
    dataType: 'json',
    url: '../postList.php',
    data: {
      showNum: showNum
    },
    success: function(json) {
      var res_content = json.res_content;
      var res_nickname = json.res_nickname;
      var res_created = json.res_created;
      var res_num = json.res_num;
      lastSeq = json.res_lastPostSeq;
      postList(res_content, res_nickname, res_created, res_num);
      if(res_num < showNum){
        $('.more').remove();
      }
    },
    error: function() {
      alert('오류: 관리자에게 문의하세요.');
    }
  });
});

$('.more').click(function() {
  $.ajax({
    type: 'post',
    dataType: 'json',
    url: '../postListMore.php',
    data: {
      lastSeq: lastSeq,
      showNum: showNum
    },
    success: function(json) {
      var res_content = json.res_content;
      var res_nickname = json.res_nickname;
      var res_created = json.res_created;
      var res_num = json.res_num;
      lastSeq = json.res_lastPostSeq;

      if(res_num){
        postList(res_content, res_nickname, res_created, res_num);
        $('.more').remove();
      } else {
        postList(res_content, res_nickname, res_created, showNum);
      }

    },
    error: function() {
      alert('오류: 관리자에게 문의하세요.');
    }
  });
});

function postList(content, nickname, created, cycle) {
  for (var i = 0; i < cycle; i++) {
    $('.forum_general').append("<div><p class = \"postContent\">" + content[i] + "</p><p class = \"postedTime\">" + nickname[i] + " " + created[i] + "</p></div>");
  }
}

function postData(addr, review, nick, data_created) {
  $('.data_general').append("<p>"+addr+"</p>");
  for (var i = 0; i < review.length; i++) {
    $('.data_general').append("<div><p class = \"postContent\">" + review[i] + "</p><p class = \"postedTime\">" + nick[i] + " " + data_created[i] + "</p></div>");
  }
}

$('.selectBox').change(function() {
  $('.data_general').empty();
  var selectHouse = $('.selectBox option:selected').val();
  if(selectHouse !== 'a'){
    $.ajax({
      type: 'post',
      dataType: 'json',
      url: '../dataList.php',
      data: {
        selectHouse: selectHouse
      },
      success: function(json) {
        var res_addr = json.res_addr;
        var res_review = json.res_review;
        var res_nick = json.res_nick;
        var res_created = json.res_created;
        
        postData(res_addr, res_review, res_nick, res_created);
      },
      error: function() {
        alert('오류: 관리자에게 문의하세요.');
      }
    });
  }
  
});
