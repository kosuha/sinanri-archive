var mapContainer = document.getElementById('map'), // 지도를 표시할 div
  mapOption = {
    center: new kakao.maps.LatLng(36.6206647, 127.288071), // 지도의 중심좌표
    level: 1, // 지도의 확대 레벨
  };

// 지도를 생성합니다
var map = new kakao.maps.Map(mapContainer, mapOption);

kakao.maps.Tileset.add('TILE_NUMBER',
  new kakao.maps.Tileset({
    width: 256,
    height: 256,
    getTile: function(x, y, z) {
      var div = document.createElement('div');
      div.style.background = 'rgba(255,255,255,1)';
      return div;
    }
  }));

// 지도 위에 TILE_NUMBER 오버레이 레이어를 추가합니다
map.addOverlayMapTypeId(kakao.maps.MapTypeId.TILE_NUMBER);


// 주소-좌표 변환 객체를 생성합니다
var geocoder = new kakao.maps.services.Geocoder();

// 커스텀 오버레이에 표시할 내용입니다
// HTML 문자열 또는 Dom Element 입니다

for (var i = 0; i < addrData.length; i++) {
  var addrVal_ = addrData[i];
  var imgVal_ = imgData[i];

  test(addrVal_, imgVal_);
}

function test(addrVal, imgVal) {
  geocoder.addressSearch(addrVal, function(result, status) {
    if (status === kakao.maps.services.Status.OK) {
      var coords = new kakao.maps.LatLng(result[0].y, result[0].x);
      // 커스텀 오버레이를 생성합니다
      var content = '<div><img class=\"contentImg\" src = ' + imgVal + ' /></div>';
      var customOverlay = new kakao.maps.CustomOverlay({
        position: coords,
        content: content,
        xAnchor: 0.5,
        yAnchor: 0.5
      });
      // 커스텀 오버레이를 지도에 표시합니다
      customOverlay.setMap(map);
      map.setCenter(coords);
    }
  });
}

function searchDetailAddrFromCoords(coords, callback) {
  // 좌표로 법정동 상세 주소 정보를 요청합니다
  geocoder.coord2Address(coords.getLng(), coords.getLat(), callback);
}

// kakao.maps.event.addListener(map, 'zoom_changed', function() {        
    
//   // 지도의 현재 레벨을 얻어옵니다
//   var level = map.getLevel();
  
//   if(level > 2){
//       map.setLevel(level - 1);
//   }
  
// });

function setZoomable(zoomable) {
  // 마우스 휠로 지도 확대,축소 가능여부를 설정합니다
  map.setZoomable(zoomable);    
}