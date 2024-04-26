<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

/**
 * Service for retrieve data from api openstreetmap
 */
class ApiWeatherService {
    protected $baseUrl;
    protected $apiKey;

    public function __construct(){
        $this->baseUrl = config('services.weather.base_url');
        $this->apiKey = config('services.weather.api_key');
    }
    
    /**
     * Retrieve data weather by city
     * 
     * @param $city
     * @return array|null Returns the weather data as an associative array if the request is successful; otherwise, returns null.
     * @throws \Illuminate\Http\Client\RequestException If the HTTP request fails. 
     */
    public function getWeatherByCity($city) {
        $city = urlencode($city);
        $response = Http::get("{$this->baseUrl}/data/2.5/weather?lang=pt_br&q={$city}&appid={$this->apiKey}&units=metric")->throw();

        if ($response->successful()) {
            return $response->json();
        } else {
            return null;
        }
    }    
}

?>