var station = [];
$.ajax({
       url : "https://download.data.grandlyon.com/ws/rdata/jcd_jcdecaux.jcdvelov/all.json", // La ressource ciblée
       type : 'GET', // Le type de la requête HTTP.
        async:false,
        dataType : 'json',
        success : function(resultat, statut){
            var liste = "<table id='myTable' class='striped'><thead><tr><th>Number</th><th>Name</th><th>Commune</th><th>Address</th><th>Bike stands</th><th>Available bike stands</th><th>Available bikes</th></tr></thead><tbody>";
            for(var i=0; i<resultat["values"].length;i++){
                station[i] = resultat.values[i];
                liste += '<tr><td>' + station[i].number + '</td><td>' +
                        station[i].name + '</td><td>' + station[i].commune + '</td><td>' + station[i].address +
                        '</td><td>' + station[i].bike_stands + '</td><td>' +
                        station[i].available_bike_stands + '</td><td>' +
                        station[i].available_bikes + '</td></tr>';
            }
            liste += '</tbody></table>'
            document.getElementById("id01").innerHTML = liste;

    }});

// déterminer l'index des colonnes les colonnes
var colonnes = {};
$("#myTable thead th").each(function(index, th)
{
  colonnes[index] = $(th).text();
}
);

// faire la recherche dans le tableau
$("#search").keyup(function()
{
  var mots = $(this).val().toLowerCase().split(" ");
  $("#myTable tbody tr").each(function(index, tr)
  {
      if (mots[0].length > 0) $(tr).hide(); else $(tr).show();
      $("td", tr).each(function(index, td)
      {
        if (colonnes[index] in {'Number':true, 'Name':true, 'Commune':true})
        {
          for (mot in mots)
          {
            if (mots[mot].length > 0 && $(td).text().toLowerCase().indexOf(mots[mot])>= 0)
            {
              $(tr).show();
              return false;
            }
          }
        }
      });
  });
});

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
