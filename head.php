<head>
    <meta charset="utf-8">
    <title>PTUT</title>
    <link href="style/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <?php if(preg_match('/map.php$/' , "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]")) : ?>
        <script src="http://paginationjs.com/dist/2.0.7/pagination.min.js"></script>
        <style type="text/css">
            html, body { height: 100%; margin: 0; padding: 0; }
            #map { height: 100%; }
        </style>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwCRQ2_uyv61FiqnD9V0EuoBon-xdSpc4&callback=initMap">
        </script>
    <?php endif; ?>
</head>