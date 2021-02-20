var mapContainer = document.getElementById('map'), // 지도를 표시할 div
  mapOption = {
    center: new kakao.maps.LatLng(36.6206647, 127.288071), // 지도의 중심좌표
    level: 3 // 지도의 확대 레벨
  };

// 지도를 생성합니다
var map = new kakao.maps.Map(mapContainer, mapOption);

// 일반 지도와 스카이뷰로 지도 타입을 전환할 수 있는 지도타입 컨트롤을 생성합니다
var mapTypeControl = new kakao.maps.MapTypeControl();

// 지도에 컨트롤을 추가해야 지도위에 표시됩니다
// kakao.maps.ControlPosition은 컨트롤이 표시될 위치를 정의하는데 TOPRIGHT는 오른쪽 위를 의미합니다
map.addControl(mapTypeControl, kakao.maps.ControlPosition.TOPRIGHT);

// 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
var zoomControl = new kakao.maps.ZoomControl();
map.addControl(zoomControl, kakao.maps.ControlPosition.RIGHT);

// 주소-좌표 변환 객체를 생성합니다
var geocoder = new kakao.maps.services.Geocoder();

// 클릭한 위치를 표시할 마커입니다
var marker = new kakao.maps.Marker();

// 현재 지도 중심좌표로 주소를 검색해서 지도 좌측 상단에 표시합니다
searchAddrFromCoords(map.getCenter(), displayCenterInfo);

// 지도를 클릭했을 때 클릭 위치 좌표에 대한 주소정보를 표시하도록 이벤트를 등록합니다
kakao.maps.event.addListener(map, 'click', function(mouseEvent) {
  searchDetailAddrFromCoords(mouseEvent.latLng, function(result, status) {
    if (status === kakao.maps.services.Status.OK && result[0].road_address) {
      var addrContent = result[0].road_address.address_name;

      // 마커를 클릭한 위치에 표시합니다
      marker.setPosition(mouseEvent.latLng);
      marker.setMap(map);

      $('.address').val(addrContent);
    }
  });
});

function searchAddrFromCoords(coords, callback) {
  // 좌표로 행정동 주소 정보를 요청합니다
  geocoder.coord2RegionCode(coords.getLng(), coords.getLat(), callback);
}

function searchDetailAddrFromCoords(coords, callback) {
  // 좌표로 법정동 상세 주소 정보를 요청합니다
  geocoder.coord2Address(coords.getLng(), coords.getLat(), callback);
}

// 지도 좌측상단에 지도 중심좌표에 대한 주소정보를 표출하는 함수입니다
function displayCenterInfo(result, status) {
  if (status === kakao.maps.services.Status.OK) {
    var infoDiv = document.getElementById('centerAddr');

    for (var i = 0; i < result.length; i++) {
      // 행정동의 region_type 값은 'H' 이므로
      if (result[i].region_type === 'H') {
        infoDiv.innerHTML = result[i].address_name;
        break;
      }
    }
  }
}

//주소를 검색하여 지도에 표시합니다
$('.address').blur(function() {

  var userAddr = $(this).val();

  geocoder.addressSearch(userAddr, function(result, status) {

    // 정상적으로 검색이 완료됐으면
    if (status === kakao.maps.services.Status.OK && result[0].road_address) {

      var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

      marker.setPosition(coords);
      marker.setMap(map);

      // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
      $('#addrComment').html('');
      map.setCenter(coords);
      var checkAddressSubmit = true;
    } else {
      $('#addrComment').html('유효하지 않은 주소입니다.');
      var checkAddressSubmit = false;
    }
  });
});

$('.address').click(function() {
  var userAddr = $('.address').val();

  geocoder.addressSearch(userAddr, function(result, status) {

    // 정상적으로 검색이 완료됐으면
    if (status === kakao.maps.services.Status.OK) {

      var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

      marker.setPosition(coords);
      marker.setMap(map);

      // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
      map.setCenter(coords);
    }
  });
});

// DB에 저장된 건물을 지도에 표시합니다 가져올것: 주소, 원룸이름 array로

var imageSrc = "http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png";

for (var i = 0; i < houseNameDB.length; i++) {
  geocoder.addressSearch(addressDB[i], function(result, status) {

    // 마커 이미지의 이미지 크기 입니다
    var imageSize = new kakao.maps.Size(16, 20);

    // 마커 이미지를 생성합니다
    var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize);

    // 정상적으로 검색이 완료됐으면
    if (status === kakao.maps.services.Status.OK) {

      var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

      // 결과값으로 받은 위치를 마커로 표시합니다
      var databaseMarker = new kakao.maps.Marker({
        map: map,
        position: coords,
        title: houseNameDB[i],
        image: markerImage
      });
    }
  });
}
