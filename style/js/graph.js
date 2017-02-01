var tabCommune =["Lyon 1", "Lyon 2", "Lyon 3", "Lyon 4", "Lyon 5", "Lyon 6", "Lyon 7", "Lyon 8", "Lyon 9", "Villeurbanne", "Caluire-et-Cuire", "Vénissieux", "Vaulx-en-Velin"];
var tab = [["Commune", "Nombres de stations"]];
function remplirTab(tableau) {
  for(var i = 0; i< tabCommune.length; i++){
    tableau.push([tabCommune[i], null]);
  }
  for (var i = 0; i < stations.length; i++) {
      switch(stations[i].commune){
        case "Lyon 1 er":
          tableau[1][1] += 1;
          break;
        case "Lyon 2 ème":
          tableau[2][1] += 1;
          break;
        case "Lyon 3 ème":
          tableau[3][1] += 1;
          break;
        case "Lyon 4 ème":
          tableau[4][1] += 1;
          break;
        case "Lyon 5 ème":
          tableau[5][1] += 1;
          break;
        case "Lyon 6 ème":
          tableau[6][1] += 1;
          break;
        case "Lyon 7 ème":
          tableau[7][1] += 1;
          break;
        case "Lyon 8 ème":
          tableau[8][1] += 1;
          break;
        case "Lyon 9 ème":
          tableau[9][1] += 1;
          break;
        case "VILLEURBANNE":
          tableau[10][1] += 1;
          break;
        case "CALUIRE-ET-CUIRE":
          tableau[11][1] += 1;
          break;
        case "VENISSIEUX":
          tableau[12][1] += 1;
          break;
        case "VAULX-EN-VELIN":
          tableau[13][1] += 1;
          break;
        default:
          break;
      }
   }
}
remplirTab(tab);

google.charts.load('current', {packages: ['corechart']});
google.charts.setOnLoadCallback(drawChart);
google.charts.setOnLoadCallback(drawChart2);

(function() { // don't leak
    var elm = document.getElementById('stationId'), // get the select
        df = document.createDocumentFragment(); // create a document fragment to hold the options while we create them
    for (var i = 0; i < stations.length; i++) { // loop, i like 42.
        var option = document.createElement('option'); // create the option element
        option.value = stations[i].number; // set the value property
        option.appendChild(document.createTextNode(stations[i].name)); // set the textContent in a safe way.
        df.appendChild(option); // append the option to the document fragment
    }
    elm.appendChild(df); // append the document fragment to the DOM. this is the better way rather than setting innerHTML a bunch of times (or even once with a long string)
    //drawChart2(stations[0].number);
}());

$('select').on('change', function() {
  drawChart2(this.value);
})

function drawChart() {
        var data = google.visualization.arrayToDataTable(tab);
        var options = {
          title: 'Nombre de stations vélo\'v par commune',
          legend: { position: 'none' },
          pieHole: 0.4,
        };
        var chart = new google.visualization.PieChart(document.getElementById('stationCommune'));
        chart.draw(data, options);
      }
function drawChart2(id) {
  moyenneStation = new Array();
  $.ajax({
    type: "POST",
    url: "http://localhost/PTUT1/moyennePlacesJournee.php",
    data: {'id': id},
    async: false,
    success:function(context){
          moyenneStation = context;

    },
    dataType:"json"
  });
  var tab2 = [["Heure","Moyenne de places libres"]];
  for (var i = 0; i<23; i++) {
    tab2.push([i + ":00", moyenneStation[i]]);
  }
  var data2 = google.visualization.arrayToDataTable(tab2);
  var options2 = {
    title: 'Moyenne de vélo disponible par heure',
    legend: { position: 'none' },
  };
  var chart2 = new google.visualization.LineChart(document.getElementById('moyennePlaceDispo'));
  chart2.draw(data2, options2);
}
