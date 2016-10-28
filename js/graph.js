var villeurbanne = 0;
var lyon7 = 0;
for (var i = 0; i < station.length; i++) {
  if (station[i].commune == 'VILLEURBANNE') {
    villeurbanne += 1;
  }
  if (station[i].commune == 'Lyon 7 ème') {
    lyon7 += 1;
  }
}

google.charts.load('current', {packages: ['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ["Commune", "Nombres de stations"],
          ['Villeurbanne', villeurbanne],
          ['Lyon 7', lyon7]]);

        var options = {
          title: 'Nombre de stations vélo\'v par commune',
          legend: { position: 'none' },
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
