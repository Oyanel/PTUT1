<head>
    <meta charset="utf-8" content="width=device-width, initial-scale=1.0" name="viewport">
    <title>PTUT</title>
    <link href="./style/css/bootstrap.min.css" rel="stylesheet">
    <link href="./style/css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <?php if(preg_match('/map.php$/' , "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")) : ?>
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="http://paginationjs.com/dist/2.0.7/pagination.min.js"></script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwCRQ2_uyv61FiqnD9V0EuoBon-xdSpc4&callback=initMap">
        </script>
    <?php endif; ?>
    <?php if(preg_match('/map.php$/' , "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")) : ?>
        <script src="./style/js/donnees.js"></script>
        <script src="./style/js/map.js"></script>
    <?php endif; ?>
</head>