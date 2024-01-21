<?php

namespace Tests\Feature;

use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\ApiTestCase;
use Tests\CreatesApplication;

class BrandTest extends ApiTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    private $fields = ['id', 'name', 'manufacturer', 'created_at', 'updated_at'];

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call(command: 'migrate');
        Artisan::call(command: 'migrate:fresh');
    }

    /**
     * Testando listagem de marcas
     * Verifica um retorno com sucesso para o end point GET /brands
     *
     * @test
     */
    public function check_list_return_with_success(): void
    {
        $brands = Brand::factory(count: 5)->create();
        $response = $this->token()->get(uri: '/api/v1/brands');
        $response->assertStatus(status: 200);
        $response->assertJsonPath(path: "message", expect: trans(key: 'messages.brands.listing_successfully'));
        $response->assertJsonCount(count: 5, key: 'data');
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [$this->fields],
            'metadata'
        ]);

        foreach ($brands as $k => $brand) {
            $response->assertJsonPath(path: "data.$k.name", expect: $brand->name);
        }
    }

    /**
     * Testando criação de marca
     * Verifica um retorno com sucesso para o end point POST /brands
     *
     * @test
     */
    public function check_create_return_with_success(): void
    {
        $brand = Brand::factory()->definition();
        $response = $this->token()->post(uri: '/api/v1/brands', data: $brand);
        $response->assertStatus(status: 200);
        $response->assertJsonPath(path: "message", expect: trans(key: 'messages.brands.creating_successfully'));
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => $this->fields,
            'metadata'
        ]);

        $response->assertJsonPath(path: "data.name", expect: $brand['name']);
    }

    /**
     * Testando atualização de marca
     * Verifica um retorno com sucesso para o end point PUT /brands/{id}
     *
     * @test
     */
    public function check_update_return_with_success(): void
    {
        $brand = Brand::factory()->create();
        $newName = fake()->name();
        $newManufacturer = fake()->name();
        $response = $this->token()->put(uri: '/api/v1/brands/' . $brand->id, data: [
            'name' => $newName,
            'manufacturer' => $newManufacturer,
        ]);
        $response->assertStatus(status: 200);
        $response->assertJsonPath(path: "message", expect: trans(key: 'messages.brands.updating_successfully'));
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => $this->fields,
            'metadata'
        ]);

        $response->assertJsonPath(path: "data.name", expect: $newName);
        $response->assertJsonPath(path: "data.manufacturer", expect: $newManufacturer);
    }

    /**
     * Testando exclusão de marca
     * Verifica um retorno com sucesso para o end point DELETE /brands/{id}
     *
     * @test
     */
    public function check_delete_return_with_success(): void
    {
        $brand = Brand::factory()->create();
        $response = $this->token()->delete(uri: '/api/v1/brands/' . $brand->id);
        $response->assertStatus(status: 200);
        $response->assertJsonPath(path: "message", expect: trans(key: 'messages.brands.deleting_successfully'));
        $response->assertJsonStructure([
            'success',
            'message',
            'data',
            'metadata'
        ]);

        $this->assertNull(Brand::find($brand->id));
    }
}
