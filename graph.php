<!DOCTYPE html>
<html lang="fr">
<?php include_once './includes/head.php' ?>
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="style/js/donnees.js"></script>
<body>
<div class="background-image"></div>
<div class="content container">
    <?php include_once './includes/header.html' ?>
    <div class="container-fluid">
        <div id="stationCommune" class="chart_div transparent"></div>
        <select id="stationId"></select>
        <div id="moyennePlaceDispo" class="chart_div transparent"></div>
        <script src="style/js/graph.js"></script>
    </div>
    <?php include_once './includes/footer.php' ?>
</div>
</body>
</html>
