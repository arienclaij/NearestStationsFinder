<?php
class NearestStationsFinder {
    private string $apiKey;
    private string $apiUrl = "https://gateway.apiportal.ns.nl/reisinformatie-api/api/v2/stations/nearest";

    public function __construct(string $apiKey) {
        $this->apiKey = $apiKey;
    }

    public function getNearestStations(float $lat, float $lon, int $limit = 2): array {
        $url = "$this->apiUrl?lat=$lat&lng=$lon&limit=$limit";
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Cache-Control: no-cache',
            'Ocp-Apim-Subscription-Key: ' . $this->apiKey
        ]);

        $response = curl_exec($curl);
        if ($response === false) {
            throw new Exception("There is something wrong retrieving the stations: " . curl_error($curl));
        }
        curl_close($curl);

        $data = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("The is a problem with the JSON: " . json_last_error_msg());
        }

        return $data['payload'] ?? [];
    }
}