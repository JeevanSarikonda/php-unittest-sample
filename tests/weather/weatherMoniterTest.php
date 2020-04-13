<?php

use PHPUnit\Framework\TestCase;
use App\TemperatureService;
use App\WeatherMoniter;

class WeatherMoniterTest extends TestCase
{
    public function tearDown(): void
    {
        \Mockery::close();
    }

    public function test_CorrectAverageIsReturned()
    {
        $service = $this->createMock(TemperatureService::class);

        $map = [
            ['12:00', 20],
            ['14:00', 26]
        ];

        $service->expects($this->exactly(2))
                ->method('getTemperature')
                ->will($this->returnValueMap($map));
        $weather = new WeatherMoniter($service);
        
        $this->assertEquals(23, $weather->getAverageTemperature('12:00', '14:00'));
    }

    public function test_CorrectAverageIsReturnedWithMockery()
    {
        $service = Mockery::mock(TemperatureService::class);

        $service->shouldReceive('getTemperature')->once()->with('12:00')->andReturn(20);
        $service->shouldReceive('getTemperature')->once()->with('14:00')->andReturn(26);

        $weather = new WeatherMoniter($service);
        $this->assertEquals(23, $weather->getAverageTemperature('12:00', '14:00'));
    }
}