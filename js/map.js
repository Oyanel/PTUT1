function initMap() {
    var lyon = {lat: 45.750000, lng: 4.850000};
    var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 13,
    center: lyon

  });

  var locations = [];
  for(var i = 0; i<station.length; i++) {
    var LatLng = {lat: parseFloat(station[i].lat), lng: parseFloat(station[i].lng)};
    locations.push(LatLng);
  }
    var markers = locations.map(function(location, i) {
          var infowindow = new google.maps.InfoWindow({
            content: "<b>" + station[i].name + "</b></br>Nombre de vélos : " + station[i].bike_stands + "</br>Nombre de places : " + station[i].available_bike_stands
          });

          var marker = new google.maps.Marker({
            position: location,
            title: station[i].name
          });

          marker.addListener('click', function() {
            infowindow.open(map, marker);
          });

          return marker;
        });

  var markerCluster = new MarkerClusterer(map, markers,{imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
}
