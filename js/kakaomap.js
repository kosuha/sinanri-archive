var mapContainer = document.getElementById('map'), // 지도를 표시할 div
  mapOption = {
    center: new kakao.maps.LatLng(36.6206647, 127.288071), // 지도의 중심좌표
    level: 3 // 지도의 확대 레벨
  };

// 지도를 생성합니다
var map = new kakao.maps.Map(mapContainer, mapOption);

// 주소-좌표 변환 객체를 생성합니다
var geocoder = new kakao.maps.services.Geocoder();

// 일반 지도와 스카이뷰로 지도 타입을 전환할 수 있는 지도타입 컨트롤을 생성합니다
var mapTypeControl = new kakao.maps.MapTypeControl();

// 지도에 컨트롤을 추가해야 지도위에 표시됩니다
// kakao.maps.ControlPosition은 컨트롤이 표시될 위치를 정의하는데 TOPRIGHT는 오른쪽 위를 의미합니다
map.addControl(mapTypeControl, kakao.maps.ControlPosition.TOPRIGHT);

// 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
var zoomControl = new kakao.maps.ZoomControl();
map.addControl(zoomControl, kakao.maps.ControlPosition.RIGHT);

// DB에 저장된 건물을 지도에 표시합니다
var imageSrc = "http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png";

for (var i = 0; i < houseNameDB.length; i++) {

  addrVal = addressDB[i];
  houseVal = houseNameDB[i];

  geocoder.addressSearch(addrVal, function(result, status) {
    if (status === kakao.maps.services.Status.OK) {
      var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

      // 마커 이미지의 이미지 크기 입니다
      var imageSize = new kakao.maps.Size(16, 20);

      // 마커 이미지를 생성합니다
      var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize);

      // 결과값으로 받은 위치를 마커로 표시합니다
      var databaseMarker = new kakao.maps.Marker({
        map: map,
        position: coords,
        image: markerImage
      });

      //마커를 클릭하면 마커의 좌표를 주소로 변환한다.
      kakao.maps.event.addListener(databaseMarker, 'click', function() {
        searchDetailAddrFromCoords(coords, function(result, status) {
          if (status === kakao.maps.services.Status.OK && result[0].road_address) {
            var addrContent = result[0].road_address.address_name;
            jsonAddr(addrContent);
          }
        });
      });
    }
  });
}

function searchDetailAddrFromCoords(coords, callback) {
  // 좌표로 법정동 상세 주소 정보를 요청합니다
  geocoder.coord2Address(coords.getLng(), coords.getLat(), callback);
}

function jsonAddr(val) {
  $.ajax({
    type: 'post',
    dataType: 'json',
    url: '../markerClickEvent.php',
    data: {
      markerClicked: val
    },
    success: function(json) {
      var clickedHouseName = json.res_clickedHouseName;
      // var average = "평균 "+json.res_average+" 만원";
      var review5 = json.res_review5;

      // if(json.res_average){
      //   $('.average').html(average);
      // } else {
      //   $('.average').html('');
      // }

      $('.clickedHouseName').html(clickedHouseName);
      $('.addr').html(val);
      $('.review5').html(review5);
    },
    error: function() {
      alert('오류: 관리자에게 문의하세요.');
    }
  });

}
