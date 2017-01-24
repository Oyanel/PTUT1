function initMap() {


    // if (navigator.geolocation) {
    //     navigator.geolocation.getCurrentPosition(maPosition);
    //     lyon = {
    //         lat: navigator.geolocation.getCurrentPosition().position.coords.latitude,
    //         lng: navigator.geolocation.getCurrentPosition().position.coords.longitude
    //     };
    // }
    // else lyon = {lat: 45.750000, lng: 4.850000};

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
        initMap2(crd);
    }

    function error(err) {
        var crd = {lat: 45.750000, lng: 4.850000};
        console.warn('ERROR(${err.code}): ${err.message}');
        initMap2(crd);
    }

    navigator.geolocation.getCurrentPosition(success, error, options);
}

function initMap2(crd) {
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
        "Nombre de vélos : " + stations[i].bike_stands + "</br>" +
        "Nombre de places : " + stations[i].available_bike_stands + "</br>" +
        "<button onclick='calcRoute(stations["+ i +"])'> Station la plus proche</button>"
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

function calcRoute(station) {
  comparaison(station);
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
   stationProche = [];
   plusProche=null;
}
