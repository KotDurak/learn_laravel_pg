<?php

namespace Tests\Unit;

use App\Models\Trip;
use Illuminate\Database\Connection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

//docker-compose run --rm artisan test --filter TripsTest
class TripsTest extends TestCase
{
    use RefreshDatabase;

    private Trip $trip;

    /**
     * @var MockObject|Connection
    */
    private MockObject $database;

    protected function setUp(): void
    {
        parent::setUp();
        $this->trip = new Trip();

    }

    public function test_is_trip()
    {
        $this->assertInstanceOf(Trip::class, $this->trip);
    }

    public function test_mock()
    {
        $trip = Trip::factory(1)->create()->first();
        $this->assertNotEmpty($trip->route);
    }
}
