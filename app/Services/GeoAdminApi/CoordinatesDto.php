<?php

namespace App\Services\GeoAdminApi;

class CoordinatesDto
{
    public float $lat;

    public float $lon;

    public function __construct(float $lat, float $lon)
    {
        $this->lat = $lat;
        $this->lon = $lon;
    }
}
