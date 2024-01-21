<?php

namespace Tests\Feature;

use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\ApiTestCase;
use Tests\CreatesApplication;

class CityTest extends ApiTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    private $fields = ['id', 'name', 'created_at', 'updated_at'];

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call(command: 'migrate');
        Artisan::call(command: 'migrate:fresh');
    }

    /**
     * Testando listagem de cidades
     * Verifica um retorno com sucesso para o end point GET /cities
     *
     * @test
     */
    public function check_list_return_with_success(): void
    {
        $cities = City::factory(count: 5)->create();
        $response = $this->token()->get(uri: '/api/v1/cities');
        $response->assertStatus(status: 200);
        $response->assertJsonPath(path: "message", expect: trans(key: 'messages.cities.listing_successfully'));
        $response->assertJsonCount(count: 5, key: 'data');
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [$this->fields],
            'metadata'
        ]);

        foreach ($cities as $k => $city) {
            $response->assertJsonPath(path: "data.$k.name", expect: $city->name);
        }
    }

    /**
     * Testando criação de cidade
     * Verifica um retorno com sucesso para o end point POST /cities
     *
     * @test
     */
    public function check_create_return_with_success(): void
    {
        $city = City::factory()->definition();
        $response = $this->token()->post(uri: '/api/v1/cities', data: $city);
        $response->assertStatus(status: 200);
        $response->assertJsonPath(path: "message", expect: trans(key: 'messages.cities.creating_successfully'));
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => $this->fields,
            'metadata'
        ]);

        $response->assertJsonPath(path: "data.name", expect: $city['name']);
    }

    /**
     * Testando atualização de cidade
     * Verifica um retorno com sucesso para o end point PUT /cities/{id}
     *
     * @test
     */
    public function check_update_return_with_success(): void
    {
        $city = City::factory()->create();
        $newName = fake()->city();
        $response = $this->token()->put(uri: '/api/v1/cities/' . $city->id, data: ['name' => $newName]);
        $response->assertStatus(status: 200);
        $response->assertJsonPath(path: "message", expect: trans(key: 'messages.cities.updating_successfully'));
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => $this->fields,
            'metadata'
        ]);

        $response->assertJsonPath(path: "data.name", expect: $newName);
    }

    /**
     * Testando exclusão de cidade
     * Verifica um retorno com sucesso para o end point DELETE /cities/{id}
     *
     * @test
     */
    public function check_delete_return_with_success(): void
    {
        $city = City::factory()->create();
        $response = $this->token()->delete(uri: '/api/v1/cities/' . $city->id);
        $response->assertStatus(status: 200);
        $response->assertJsonPath(path: "message", expect: trans(key: 'messages.cities.deleting_successfully'));
        $response->assertJsonStructure([
            'success',
            'message',
            'data',
            'metadata'
        ]);

        $this->assertNull(City::find($city->id));
    }
}
