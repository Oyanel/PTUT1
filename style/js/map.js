function initMap() {
    var lyon = {lat: 45.750000, lng: 4.850000};
    var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 13,
    center: lyon
  });

  directionsDisplay = new google.maps.DirectionsRenderer();
  directionsService = new google.maps.DirectionsService();
  directionsDisplay.setMap(map);
  var locations = [];
  for(var i = 0; i<stations.length; i++) {
    var LatLng = {lat: parseFloat(stations[i].lat), lng: parseFloat(stations[i].lng)};
    locations.push(LatLng);
  }
    var markers = locations.map(function(location, i) {
          var infoWindow = new google.maps.InfoWindow({
            content:
            "<b>" + stations[i].name + "</b></br>" +
            "Nombre de vélos : " + stations[i].bike_stands + "</br>" +
            "Nombre de places : " + stations[i].available_bike_stands + "</br>" +
            "<button>Click Me !</button>"
          });

          var marker = new google.maps.Marker({
            position: location,
            title: stations[i].name
          });

          marker.addListener('click', function() {
              map.panTo(marker.getPosition());
              if(map.zoom <=16) map.setZoom(16);
              if (typeof( window.infoopened ) != 'undefined') infoopened.close();

              infoWindow.open(map, marker);
              infoopened = infoWindow;
          });

          return marker;
        });

  var markerCluster = new MarkerClusterer(map, markers,{imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
  calcRoute();
}
function calcRoute() {
   current_pos = {lat: parseFloat(stationProche[0].sta.lat), lng: parseFloat(stationProche[0].sta.lng)};
   end_pos = {lat: parseFloat(plusProche.sta.lat), lng: parseFloat(plusProche.sta.lng)};
   var request = {
      origin:current_pos,
      destination:end_pos,
      travelMode: google.maps.TravelMode.WALKING
   };

   directionsService.route(request, function(result, status) {
      if (status == google.maps.DirectionsStatus.OK) {
         directionsDisplay.setDirections(result);
      }
   });
}


