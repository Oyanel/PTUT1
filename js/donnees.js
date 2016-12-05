var station = []; // Tableau qui va contenir toutes les stations vélo'v de Lyon

// Requète de parsage du flux JSON dans le tableau JSON
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
            document.getElementById("liste").innerHTML = liste;

    }});
