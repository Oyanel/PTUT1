<?php

    require_once 'Velov.php';
    $velovStation = new Velov();
    $velovStation->getStationState();
    $velovStation->populateDB();
    $velovStation->printStations();