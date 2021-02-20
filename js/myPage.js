var lastSeq = 0;  //마지막 게시물 번호
var showNum = 7;  //보여지는 게시물 갯수 단위

$(document).ready(function() {
  $.ajax({
    type: 'post',
    dataType: 'json',
    url: '../myPostList.php',
    data: {
      showNum: showNum
    },
    success: function(json) {
      var res_content = json.res_content;
      var res_nickname = json.res_nickname;
      var res_created = json.res_created;
      var res_num = json.res_num;
      var res_id = json.res_id;
      lastSeq = json.res_lastPostSeq;
      postList(res_content, res_nickname, res_created, res_num, res_id);
      if(res_num < showNum){
        $('.myPostMore').remove();
      }
    },
    error: function() {
      alert('오류: 관리자에게 문의하세요.');
    }
  });
});

$('.myPostMore').click(function() {
  $.ajax({
    type: 'post',
    dataType: 'json',
    url: '../myPostListMore.php',
    data: {
      lastSeq: lastSeq,
      showNum: showNum
    },
    success: function(json) {
      var res_content = json.res_content;
      var res_nickname = json.res_nickname;
      var res_created = json.res_created;
      var res_num = json.res_num;
      var res_id = json.res_id;
      lastSeq = json.res_lastPostSeq;

      if(res_num){
        postList(res_content, res_nickname, res_created, res_num, res_id);
        $('.myPostMore').remove();
      } else {
        postList(res_content, res_nickname, res_created, showNum, res_id);
      }

    },
    error: function() {
      alert('오류: 관리자에게 문의하세요.');
    }
  });
});

function postList(content, nickname, created, cycle, id) {
  for (var i = 0; i < cycle; i++) {
    $('.myPost').append("<div><p class = \"postContent\">" + content[i] + "</p><p class = \"postedTime\">" + nickname[i] + " " + created[i] + "</p><p class = \"del_\" onClick=\"cf_("+ id[i] +")\">삭제</p></div>");
  }
}

function cf(v){
  // var v = $(this).attr('value');
  // console.log(v);
  $.ajax({
    type: 'post',
    dataType: 'json',
    url: '../del_data.php',
    data: {
      v: v
    },
    success: function(json) {
      location.reload();
      
    },
    error: function() {
      alert('오류: 관리자에게 문의하세요.');
    }
  });
}

function cf_(v_){
  $.ajax({
    type: 'post',
    dataType: 'json',
    url: '../del_post.php',
    data: {
      v: v_
    },
    success: function(json) {
      location.reload();
      
    },
    error: function() {
      alert('오류: 관리자에게 문의하세요.');
    }
  });
}

