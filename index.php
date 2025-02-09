<?php
include "config/config.inc.php";
include "inc/NearestStationsFinder.class.php";
include "inc/DeparturesFetcher.class.php";

try {
    if (!isset($_GET['lat'], $_GET['lon'])) {
        throw new Exception("The lat and/or lon parameters are missing in  the URL.");
    }

    $apiKey = $settings['NS_APIkey'];
    $nearestStation = new NearestStationsFinder($apiKey);
    $stations = $nearestStation->getNearestStations((float)$_GET['lat'], (float)$_GET['lon']);
    if (!empty($stations)) {
        $stationCode = $stations[0]['code'];
        $departuresFetcher = new DeparturesFetcher($apiKey);
        $departures = $departuresFetcher->getDepartures($stationCode);
        echo json_encode([
            'stationDetails' => $stations[0],
            'arrivals' => $departures
        ], JSON_PRETTY_PRINT);    } else {
        throw new Exception("No stations found.");
    }

} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()], JSON_PRETTY_PRINT);
}
