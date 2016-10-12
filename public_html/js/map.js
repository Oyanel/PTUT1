/*var station = function myFunction(arr) 
{
    var out = "";
    var i;
    for(i = 0; i<arr.length; i++) {
        out += '<h2>' + arr[i].name + '</h2><p>' + arr[i].number + '</p><br>';
    }
    //document.getElementById("id01").innerHTML = out;
    return arr;
}*/
var station = [];
$.ajax({
       url : "test.json", // La ressource ciblée
       type : 'GET', // Le type de la requête HTTP.
        async:false,
        dataType : 'json',
        success : function(resultat, statut){ 
            var liste = "<table id='myTable' class='striped'><thead><tr><th>Number</th><th>Name</th><th>Address</th><th>Bike stands</th><th>Available bike stands</th><th>Available bikes</th></tr></thead><tbody>";
            for(var i=0; i<resultat["values"].length;i++){
                station[i] = resultat.values[i];
                liste += '<tr><td>' + station[i].number + '</td><td>' + 
                        station[i].name + '</td><td>' + station[i].address + 
                        '</td><td>' + station[i].bike_stands + '</td><td>' + 
                        station[i].available_bike_stands + '</td><td>' + 
                        station[i].available_bikes + '</td></tr>';
            }
            liste += '</tbody></table>'
            document.getElementById("id01").innerHTML = liste;
            
            $('#myTable').pagination({
            dataSource: [1, 2, 3, 4, 5, 6, 7],
                callback: function(data, pagination) {
                    // template method of yourself
                    var html = template(data);
                    dataContainer.html(html);
                }
            })

    }});

function initMap() {
  var myLatLng = {lat: 45.75, lng: 4.85};

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 13,
    center: myLatLng
  });

  var marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    title: station[1].name   
  });
}

    
