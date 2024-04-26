<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\ClimateWeather;

/**
 * Saves or updates weather data based on the presence of a 'climate_weather_id'.
 *
 *
 * @param array $data Associative array of data for the weather record. Expected to contain at least 'climate_weather_id'.
 * @return ClimateWeather|null The updated or newly created weather model if successful, or null on failure.
 */
class ClimateWeatherService {

    public function saveWeather($data = array()) {
        $weather = ClimateWeather::where('climate_weather_id', $data['climate_weather_id'])->first();
        if ($weather) {
            $updateSuccessful = $weather->update($data);
            if ($updateSuccessful) {
                return $weather;
            } else {                
                return null;
            }
        } else {
            $weather = ClimateWeather::create($data);
            if ($weather) {
                return $weather;
            } else {
                return null;
            }
        }

    }    
}

?>