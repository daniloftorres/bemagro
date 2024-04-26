<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClimateWeather extends Model
{
    use HasFactory;
    protected $table = 'climate_weathers';
    protected $fillable = [
        'city', 'temperature', 'weather_condition', 'lat', 'lon',
        'wind_speed', 'humidity', 'temperature_min', 'temperature_max', 'climate_weather_id'
    ];
    
}
