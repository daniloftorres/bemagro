<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/*
protected $fillable = [
        'city', 'temperature', 'weather_condition', 'lat', 'lon',
        'wind_speed', 'humidity', 'temperature_min', 'temperature_max'
    ];


    $table->id();
            $table->string('city')->nullable();
            $table->decimal('temperature', 5, 2)->nullable();
            $table->string('weather_condition')->nullable();
            $table->timestamps();
*/
class AddNewFieldsToClimateWeathersTable extends Migration
{   
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('climate_weathers', function (Blueprint $table) {
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lon', 10, 7)->nullable();
            $table->decimal('wind_speed', 5, 2)->nullable();
            $table->decimal('humidity', 5, 2)->nullable();
            $table->decimal('temperature_min', 5, 2)->nullable();
            $table->decimal('temperature_max', 5, 2)->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('climate_weathers');
    }
}
