<?php

namespace Tests\Unit;

use Tests\CreatesApplication;
use PHPUnit\Framework\TestCase;
use Illuminate\{
    Foundation\Testing\RefreshDatabase,
    Support\Facades\Artisan,
};
use App\Models\City;
use App\Actions\Cities\{
    DeleteCity,
    StoreCity,
    UpdateCity,
};


class CityActionsTest extends TestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->createApplication();
        Artisan::call(command: 'migrate');
        Artisan::call(command: 'migrate:fresh');
    }

    public function test_store_city_successfully()
    {
        $city = City::factory()->definition();

        $storeCityAction = new StoreCity();
        $createdCity = $storeCityAction->handler(...$city);

        $this->assertInstanceOf(City::class, $createdCity);
        $this->assertEquals($city['name'], $createdCity->name);
    }

    public function test_store_city_exception()
    {
        $city = [];
        $storeCityAction = new StoreCity();

        $this->expectException(\Exception::class);

        $storeCityAction->handler(...$city);
    }

    public function test_update_city_successfully()
    {
        $city = City::factory()->create()->toArray();

        $city['name'] = fake()->city() . ' new name';

        $updateCityAction = new UpdateCity();
        $updatedCity = $updateCityAction->handler(...$city);

        $this->assertInstanceOf(City::class, $updatedCity);
        $this->assertEquals($city['name'], $updatedCity->name);
    }

    public function test_update_city_exception()
    {
        $city = City::factory()->create()->toArray();
        unset($city['id']);
        $updateCityAction = new UpdateCity();

        $this->expectException(\Exception::class);

        $updateCityAction->handler(...$city);
    }

    public function test_delete_city_successfully()
    {
        $city = City::factory()->create()->toArray();

        $deleteCityAction = new DeleteCity();
        $deleteCityAction->handler(...$city);

        $this->assertFalse(City::where('id', $city['id'])->exists());
    }

    public function test_delete_city_exception()
    {
        $city = City::factory()->create()->toArray();
        unset($city['id']);

        $deleteCityAction = new DeleteCity();

        $this->expectException(\Exception::class);
        $deleteCityAction->handler(...$city);
    }
}
