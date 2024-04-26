<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Models\ClimateWeather;
use App\Services\ApiGeolocationService;
use App\Services\ApiWeatherService;
use App\Services\ClimateWeatherService;
use Illuminate\Support\Facades\Log;

/**
 * Controller for managing climate weather data interactions
 */
class ClimateWeatherController extends Controller
{
    /**
     * Initialize the services used in the controller
     * 
     * @param ApiGeolocationService $apiGeolocationService
     * @param ApiWeatherService $apiWeatherService
     * @param ClimateWeatherService $climateWeatherService
     */

    public function __construct(
        ApiGeolocationService $apiGeolocationService, 
        ApiWeatherService $apiWeatherService,
        ClimateWeatherService $climateWeatherService){

        $this->apiGeolocationService = $apiGeolocationService;
        $this->apiWeatherService = $apiWeatherService;
        $this->climateWeatherService = $climateWeatherService;
    }

    /**
     * Fetch and display weather based on the city provided in the request
     * 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function fetchWeather(Request $request){

        if (empty($request->input('city'))) {
            return $this->returnCityMissingError();
        }

        try {
            return $this->processWeatherRequest($request);
        } catch (\Exception $e) {
            return $this->handleWeatherServiceError($e);
        }
    }

    /**
     * Process the weather request, validate data, and return the view.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    private function processWeatherRequest(Request $request)
    {
        $city = $request->input('city');
        $response_weather = $this->apiWeatherService->getWeatherByCity($city);
        if ($response_weather === null) {
            return $this->returnWeatherError();
        }
        $data_weather = $response_weather;

        $response_geolocation = $this->apiGeolocationService->getCoordinatesByCity($city);        
        if ($response_geolocation === null) {
            return $this->returnGeolocationError();
        }
        
        $data_geolocation = $response_geolocation;
        
        $this->validateWeatherData($data_weather);
        $this->validateGeolocationData($data_geolocation);
        
        $weatherData = $this->prepareWeatherData($request, $data_weather, $data_geolocation);
        return view('climate_weather.index', [
            'weather' => $this->climateWeatherService->saveWeather($weatherData),
            'weatherNotFound' => false,
            'weatherStatus' => true,
            'weatherMsg' => "Weather data successfully retrieved."
        ]);
    }

    /**
     * Handle the case when the city parameter is missing from the request.
     *
     * @return \Illuminate\View\View
     */
    private function returnWeatherError()
    {
         return view('climate_weather.index', [
            'weather' => [],
            'weatherStatus' => false,
            'weatherMsg' => __('messages.weather_service_unavailable')
        ]);
    }

    /**
     * Handle the case when the city parameter is missing from the request.
     *
     * @return \Illuminate\View\View
     */
    private function returnGeolocationError()
    {
        return view('climate_weather.index', [
            'weather' => [],
            'weatherStatus' => false,
            'weatherMsg' => __('messages.weather_service_unavailable')
        ]);
    }

    /**
     * Handle errors from the weather service.
     *
     * @param \Exception $e
     * @return \Illuminate\Http\Response
     */
    private function handleWeatherServiceError(\Exception $e)
    {
        $msg_error = $e->getCode() == 404 
            ? __('messages.city_not_found') 
            : __('messages.weather_service_unavailable');

        return response()->view('errors.custom', [
            'error' => $msg_error,
            'status' => $e->getCode() ?: 400
        ], $e->getCode() ?: 400);
    }

    /**
     * Handle the case when the city parameter is missing from the request.
     *
     * @return \Illuminate\View\View
     */
    private function returnCityMissingError()
    {
        return view('climate_weather.index', [
            'weather' => [],
            'weatherStatus' => false,
            'weatherMsg' => __('messages.param_city_empty')
        ]);
    }

    /**
     * Prepares the weather data for presentation or storage.
     *
     * @param Request $request
     * @param array $dataWeather Raw weather data from the weather API.
     * @param array $dataGeolocation Raw geolocation data from the geolocation API.
     * @return array Prepared data array with combined and formatted weather and location data.
     */
    private function prepareWeatherData(Request $request, array $dataWeather, array $dataGeolocation)
    {
        // Processa os dados recebidos para formatar conforme o necessário para a aplicação
        return [
            'climate_weather_id' => $dataWeather['id'],
            'city' => $request->input('city'),
            'temperature' => $dataWeather['main']['temp'],
            'weather_condition' => $dataWeather['weather'][0]['description'],
            'lat' => $dataGeolocation[0]['lat'],
            'lon' => $dataGeolocation[0]['lon'],
            'wind_speed' => $dataWeather['wind']['speed'],
            'humidity' => $dataWeather['main']['humidity'],
            'temperature_min' => $dataWeather['main']['temp_min'],
            'temperature_max' => $dataWeather['main']['temp_max']
        ];
    }

    /**
     * Validate data from api climate weather
     *
     * @param array $data to be validated
     * @return bool|\Illuminate\View\View Returns true if validation passes, or a view if validation fails.
     */
    private function validateWeatherData($data)
    {
        $validator = Validator::make($data, [
            'main.temp' => 'required|numeric',
            #'weather_condition' => 'required|string',
            'weather.0.description' => 'required|string',
            'wind.speed' => 'required|numeric',
            'main.humidity' => 'required|numeric',
            'main.temp_min' => 'required|numeric',
            'main.temp_max' => 'required|numeric',
        ]);
        
        if ($validator->fails()) {
            #$validator->errors()
            return view('weather', [
                'weather' => [],
                'weatherStatus' => false,
                'weatherMsg' => __('messages.weather_service_unavailable'),
            ]);
        }
    }

   /**
     * Validate data from api geolocation
     *
     * @param array $data to be validated
     * @return bool|\Illuminate\View\View Returns true if validation passes, or a view if validation fails.
     */
    private function validateGeolocationData($data)
    {        
        $validator = Validator::make($data, [
            '0.lat' => 'required|numeric',
            '0.lon' => 'nullable|numeric',
        ]);
        
        if ($validator->fails()) {
            #$validator->errors()
            return view('weather', [
                'weather' => [],
                'weatherStatus' => false,
                'weatherMsg' => __('messages.weather_service_unavailable'),
            ]);
        }
    }

    /**
     * Retrieve all climate weather records from the database
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function listWeather(Request $request){
        $weatherData = ClimateWeather::all();
        return view('climate_weather.list',['weatherData'=>$weatherData]);
    }

    /**
     * Display the form to edit climate weather
     * @param in $id
     * @return \Illuminate\View\View
     */
    public function showEditWeatherForm(int $id){
        $weather = ClimateWeather::find($id);
        return view('climate_weather.edit',['weather'=>$weather]);
    }

    /**
     * Update climate weather register
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function editWeather(Request $request, $id){
        $weather = ClimateWeather::find($id);
        if ($weather) {
            $weather->update($request->all());
            return redirect('/list-weather')->with('success','Weather updated successfully.');
        }
        return back()->with('error','Weather not found');
    }

    /**
     * Delete climate weather register
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteWeather(Request $request, $id){
        $weather = ClimateWeather::find($id);
        if ($weather){
            $weather->delete();
            return back()->with('success','Weather deleted successfully.');
        }
        return back()->with('error','Weather not found');
    }
}