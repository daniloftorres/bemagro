<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

/**
 * Service for retrieve data from api nominatim openstreetmap
 */
class ApiGeolocationService {
    protected $baseUrl;
    protected $apiKey;

    public function __construct() {
        $this->baseUrl = config('services.geolocation.base_url');
        $this->apiKey = config('services.geolocation.api_key');
    }

    /**
     * Retrieve data weather by city
     * 
     * @param $city
     * @return array|null Returns the weather data as an associative array if the request is successful; otherwise, returns null.
     * @throws \Illuminate\Http\Client\RequestException If the HTTP request fails. 
     */
    public function getCoordinatesByCity($city) {
        $response = Http::get("{$this->baseUrl}/search?format=json&limit=1&q=" . urlencode($city));
        
        if ($response->successful()) {
            return $response->json();
        } else {
            return null;
        }
    }
}

?>