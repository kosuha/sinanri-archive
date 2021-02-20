
var memberIdCheck = $('.memberIdCheck');
var memberId = $('.memberId');
var memberIdComment = $('.memberIdComment');
var memberPw = $('.memberPw');
var memberPw2 = $('.memberPw2');
var memberPw2Comment = $('.memberPw2Comment');
var memberNickName = $('.memberNickName');
var memberNickNameComment = $('.memberNickNameComment');
var memberEmailAddress = $('.memberEmailAddress');
var memberEmailAddressComment = $('.memberEmailAddressComment');
var memberName = $('.memberName');

var id_OK = 0;
var name_OK = 0;
var pw_OK = 0;
var nickname_OK = 0;
var email_OK = 0;

memberId.blur(function () {
    var idLength = memberId.val().length;
    if (5 <= idLength && idLength <= 20) {
        idJson();
    } else {
        memberIdComment.text('5~20자 이내의 영문, 숫자, 특수문자(_, -)만 사용가능합니다.');
        memberIdComment.css('color', 'red');
        memberId.focus();
    }
});

function idJson() {
    console.log(memberId.val());
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '../memberIdCheck.php',
        data: { memberId: memberId.val() },

        success: function (json) {
            if (json.res == 'good') {
                console.log(json.res);
                memberIdComment.text('사용 가능한 아이디입니다.');
                memberIdComment.css('color', 'blue');
                id_OK = 1;
            } else {
                memberIdComment.text('이미 사용 중인 아이디입니다.');
                memberIdComment.css('color', 'red');
                memberId.focus();
            }
        },

        error: function () {
            console.log('failed');

        }
    })
}

//비밀번호 자리 수 체크
memberPw.blur(function () {
    if (memberPw.val().length >= 6) {
        pwSameCheck();
    } else {
        memberPw2Comment.text('비밀번호는 6자리 이상으로 설정하세요.');
        memberPw2Comment.css('color', 'red');
        memberPw.focus();
    }
});

//비밀번호 동일 한지 체크
function pwSameCheck() {
    memberPw2.blur(function () {
        if (memberPw.val() != '' && memberPw.val().length >= 6) {
            if (memberPw.val() == memberPw2.val()) {
                memberPw2Comment.text('비밀번호가 일치합니다.');
                memberPw2Comment.css('color', 'blue');
                pw_OK = 1;
            } else {
                memberPw2Comment.text('비밀번호가 일치하지 않습니다.');
                memberPw2Comment.css('color', 'red');
            }
        }
    });
}

//이메일 유효성 검사
memberEmailAddress.blur(function () {
    var regex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
    if (regex.test(memberEmailAddress.val()) === false) {
        memberEmailAddressComment.text('유효하지 않은 이메일입니다.');
        memberEmailAddressComment.css('color', 'red');
    } else {
        memberEmailAddressComment.text('유효한 이메일입니다.');
        memberEmailAddressComment.css('color', 'blue');
        email_OK = 1;
    }
});

$(document).ready(function () {
    memberIdComment.text('5~20자 이내의 영문, 숫자, 특수문자(_, -)만 사용가능합니다.');
    memberIdComment.css('color', 'blue');
});

$(document).ready(function () {
    memberPw2Comment.text('비밀번호는 6자리 이상으로 설정하세요.');
    memberPw2Comment.css('color', 'blue');
});

$(document).ready(function () {
    memberNickNameComment.text('20자 이내의 한글, 영문, 숫자, 특수문자(_, -)만 사용가능합니다.');
    memberNickNameComment.css('color', 'blue');
});

//아이디 한글입력 안되게 처리
memberId.keyup(function (event) {

    if (!(event.keyCode >= 37 && event.keyCode <= 40)) {

        var inputVal = $(this).val();
        $(this).val(inputVal.replace(/[^a-z0-9_-]/gi, ''));
    }

});

//이름 한글만
memberName.keyup(function (event) {

    if (!(event.keyCode >= 37 && event.keyCode <= 40)) {

        var inputVal = $(this).val();
        $(this).val(inputVal.replace(/[^ㄱ-힣]/gi, ''));
    }

});

memberNickName.keyup(function (event) {

    if (!(event.keyCode >= 37 && event.keyCode <= 40)) {

        var inputVal = $(this).val();
        $(this).val(inputVal.replace(/[^a-z0-9ㄱ-힣_-]/gi, ''));
    }

});

memberNickName.blur(function () {
    if (memberNickName.val() != '') {
        nickname_OK = 1;
    }
});

memberName.blur(function () {
    if (memberName.val() != '') {
        name_OK = 1;
    }
});

$(document).ready(function () {
    $('#submit').prop('disabled', true);
});

function submitCheck() {
    if (id_OK == 1 && name_OK == 1 && pw_OK == 1 && nickname_OK == 1 && email_OK == 1) {
        $('#submit').prop('disabled', false);
    } else {
        $('#submit').prop('disabled', true);
    }
}

$('input').blur(function () {
    submitCheck();
});









