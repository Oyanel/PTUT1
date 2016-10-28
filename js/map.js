function initMap() {
    var myLatLng = {lat: 45.750000, lng: 4.850000};
    var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 13,
    center: myLatLng

  });

  var locations = [];
  for(var i = 0; i<station.length; i++) {
    var LatLng = {lat: parseFloat(station[i].lat), lng: parseFloat(station[i].lng)};
    locations.push(LatLng);
  }
    var markers = locations.map(function(location, i) {
          return new google.maps.Marker({
            position: location,
            title: station[i].name
          });
        });
  var markerCluster = new MarkerClusterer(map, markers,{imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
}
