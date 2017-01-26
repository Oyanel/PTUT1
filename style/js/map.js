function getPosition() {

    var options = {
        // enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0
    };

    function success(pos) {

        var crd = {lat: pos.coords.latitude, lng: pos.coords.longitude};
        console.log('Your current position is:');
        console.log('Latitude : ' + pos.coords.latitude);
        console.log('Longitude: ' + pos.coords.longitude);
        console.log('More or less ' + pos.coords.accuracy + ' meters.');
        initMap(crd);
    }

    function error(err) {
        var crd = {lat: 45.750000, lng: 4.850000};
        console.warn('ERROR(${err.code}): ${err.message}');
        initMap(crd);
    }

    navigator.geolocation.getCurrentPosition(success, error, options);
}

function initMap(crd) {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: crd
    });

    directionsDisplay = new google.maps.DirectionsRenderer();
    directionsService = new google.maps.DirectionsService();
    directionsDisplay.setMap(map);
    var locations = [];
    for (var i = 0; i < stations.length; i++) {
        var LatLng = {lat: parseFloat(stations[i].lat), lng: parseFloat(stations[i].lng)};
        locations.push(LatLng);
    }
    var markers = locations.map(function (location, i) {
      var infoWindow = new google.maps.InfoWindow({
        content:
        "<b>" + stations[i].name + "</b></br>" +
        "Nombre de vélos : " + stations[i].available_bikes + "</br>" +
        "Nombre de places libre: " + stations[i].available_bike_stands + "</br>" +
        "<button onclick='calcRoute(" + crd.lat + "," + crd.lng + ",stations[" + i + "])'> Y aller</button>"
      });

        var marker = new google.maps.Marker({
            position: location,
            title: stations[i].name
        });

        marker.addListener('click', function () {
            map.panTo(marker.getPosition());
            if (map.zoom <= 16) map.setZoom(16);
            if (typeof( window.infoopened ) != 'undefined') infoopened.close();

            infoWindow.open(map, marker);
            infoopened = infoWindow;
        });

        return marker;
    });

    var markerCluster = new MarkerClusterer(map, markers, {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});

}

function calcRoute(lat, lng, station) {
  comparaison(lat, lng, station);
   current_pos = {lat: parseFloat(lat), lng: parseFloat(lng)};
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
   stationProche = [];
   plusProche=null;
}
