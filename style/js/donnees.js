// Tableau qui va contenir toutes les stations vélo'v de Lyon
var stations = [];
// Tableau des stations les plus proches dans un rayon de ${distanceMax} mètres
var stationProche = [];
// Rayon de recherche en mètres
var rayon = 500;

// Requète de parsage du flux JSON dans le tableau JSON
$.ajax({
       url : "https://download.data.grandlyon.com/ws/rdata/jcd_jcdecaux.jcdvelov/all.json", // La ressource ciblée
       type : 'GET', // Le type de la requête HTTP.
        async:false,
        dataType : 'json',
        success : function(resultat, statut){
          // Affichage du tableau des stations
            var liste = "<table id='myTable' class='table table-responsive table-striped'><thead><tr><th>Number</th><th>Name</th><th>Commune</th><th>Address</th><th>Bike stands</th><th>Available bike stands</th><th>Available bikes</th></tr></thead><tbody>";
            for(var i=0; i<resultat["values"].length;i++){
                stations[i] = resultat.values[i];
                liste += '<tr><td>' + stations[i].number + '</td><td>' +
                        stations[i].name + '</td><td>' + stations[i].commune + '</td><td>' + stations[i].address +
                        '</td><td>' + stations[i].bike_stands + '</td><td>' +
                        stations[i].available_bike_stands + '</td><td>' +
                        stations[i].available_bikes + '</td></tr>';
            }
            liste += '</tbody></table>'
            document.getElementById("liste").innerHTML = liste;

    }});

//Conversion des degrés en radian
function convertRad(input){
        return (Math.PI * input)/180;
}

function Distance(station1, station2){

    R = 6378000 //Rayon de la terre en mètre

    lat_a = convertRad(station1.lat);
    lon_a = convertRad(station1.lng);
    lat_b = convertRad(station2.lat);
    lon_b = convertRad(station2.lng);

    d = R * (Math.PI/2 - Math.asin( Math.sin(lat_b) * Math.sin(lat_a) + Math.cos(lon_b - lon_a) * Math.cos(lat_b) * Math.cos(lat_a)))
    return d; //Distance en mètres
}

function comparaison(station){
    for(var i=0; i<stations.length;i++){
      var proche = {
        sta: stations[i],
        distance: Distance(station,stations[i])
      };
      if(stations[i].number != station.number){
        if (Distance(station,stations[i])<=rayon) {
          stationProche.push(proche);
        }
      } else {
        stationProche.unshift(proche);
      }
    }
}
comparaison(stations[294]);
var plusProche = stationProche[1];
for(var i=1; i<stationProche.length;i++){
  if(stationProche[i].sta.available_bike_stands>0){
    if(stationProche[i].distance < plusProche.distance){
      plusProche = stationProche[i];
    }
  }
}
console.log(stationProche[0].sta.name);
console.log(plusProche.sta.name);
