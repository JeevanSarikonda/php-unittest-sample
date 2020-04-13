<?php
namespace App;

class WeatherMoniter
{
    /**
     * Temperature Service
     * @var TemperatureService
     */
    protected $service;

    /**
     * Constructor
     * 
     * @param TemperatureService $service Temperature service dependency
     * @return void
     */
    public function __construct(TemperatureService $service)
    {
        $this->service = $service;
    }

    /**
     * Get average temperature between two times
     * 
     * @param string $start Start time in hh:mm format
     * @param string $end End time in hh:mm format
     * 
     * @return int
     */
    public function getAverageTemperature(string $start, string $end): int
    {
        $start_temp = $this->service->getTemperature($start);
        $end_temp = $this->service->getTemperature($end);

        return ($start_temp + $end_temp) / 2;
    }
}