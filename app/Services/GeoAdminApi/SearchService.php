<?php

namespace App\Services\GeoAdminApi;

class SearchService
{
    public function queryApi(string $url): array
    {
        $cURL =  curl_init($url);
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($cURL);
        curl_close($cURL);
        return json_decode($response, true);
    }

    public function getCoordinates(string $address): CoordinatesDto
    {
        $searchText = urlencode($address);
        $url = "https://api3.geo.admin.ch/rest/services/api/SearchServer?searchText=$searchText&type=locations";
        $apiData = $this->queryApi($url);
        return new CoordinatesDto(
            $apiData['results'][0]['attrs']['lat'],
            $apiData['results'][0]['attrs']['lon'],
        );
    }
}
