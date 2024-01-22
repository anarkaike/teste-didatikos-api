<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\City;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Tests\ApiTestCase;
use Tests\CreatesApplication;

class ProductTest extends ApiTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call(command: 'migrate');
        Artisan::call(command: 'migrate:fresh');
    }

    /**
     * Testando listagem de produtos
     * Verifica um retorno com sucesso para o end point GET /products
     *
     * @test
     */
    public function check_list_return_with_success(): void
    {
        Auth::login(User::factory()->create());
        $brand  = Brand::factory()->create();
        $city   = City::factory()->create();

        $products = Product::factory(count: 5)->create(['brand_id' => $brand->id, 'city_id' => $city->id,]);
        $response = $this->token()->get(uri: '/api/v1/products');
        $response->assertStatus(status: 200);
        $response->assertJsonPath(path: "message", expect: trans(key: 'messages.products.listing_successfully'));
        $response->assertJsonCount(count: 5, key: 'data');
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [['id', 'name', 'brand_id', 'stock', 'city_id', 'created_by', 'updated_by', 'created_at', 'updated_at']],
            'metadata'
        ]);


        foreach ($products as $k => $product) {
            foreach (['name', 'price', 'brand_id', 'stock', 'city_id', 'created_by'] as $field) {
                $val = $field === 'price' || $field === 'stock' ? (float) number_format($product->$field, 2) : $product->$field;
                $response->assertJsonPath(path: "data.$k.$field", expect: $val);
            }
        }
    }

    /**
     * Testando listagem de produtos vazio
     * Verifica um retorno com sucesso para o end point GET /products
     *
     * @test
     */
    public function check_list_return_with_no_data(): void
    {
        $response = $this->token()->get(uri: '/api/v1/products');
        $response->assertStatus(status: 200);
        $response->assertJsonPath(path: "message", expect: trans(key: 'messages.products.listing_successfully'));
        $response->assertJsonCount(count: 0, key: 'data');
        $response->assertJsonStructure([
            'success',
            'message',
            'data',
            'metadata'
        ]);
    }

    /**
     * Testando criação de produto
     * Verifica um retorno com sucesso para o end point POST /products
     *
     * @test
     */
    public function check_create_return_with_success(): void
    {
        Auth::login(User::factory()->create());
        $brand  = Brand::factory()->create();
        $city   = City::factory()->create();

        $product = Product::factory()->definition();
        $product['brand_id'] = $brand->id;
        $product['city_id'] = $city->id;
        $response = $this->token()->post(uri: '/api/v1/products', data: $product);
        $response->assertStatus(status: 200);
        $response->assertJsonPath(path: "message", expect: trans(key: 'messages.products.creating_successfully'));
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => ['id', 'name', 'brand_id', 'stock', 'city_id', 'created_by', 'created_at', 'updated_at'],
            'metadata'
        ]);

        foreach (['name', 'price', 'brand_id', 'stock', 'city_id'] as $field) {
            $response->assertJsonPath(path: "data.$field", expect: $product[$field]);
        }
    }

    /**
     * Testando criação de produto com erro quando deixamos de enviar os dados
     * Verifica um retorno com sucesso para o end point POST /products
     *
     * @test
     */
    public function check_create_return_with_error(): void
    {
        $response = $this->token()->post(uri: '/api/v1/products');
        $response->assertStatus(status: 400);
        $response->assertJsonPath(path: "message", expect: trans(key: 'validation.invalid_data'));
        $response->assertJsonStructure([
            'success',
            'message',
            'data',
        ]);
    }

    /**
     * Testando atualização de produto
     * Verifica um retorno com sucesso para o end point PUT /products/{id}
     *
     * @test
     */
    public function check_update_return_with_success(): void
    {
        Auth::login(User::factory()->create());
        $brand  = Brand::factory()->create();
        $city   = City::factory()->create();
        $newBrand  = Brand::factory()->create();
        $newCity   = City::factory()->create();

        $product = Product::factory()->create(['brand_id' => $brand->id, 'city_id' => $city->id,]);
        $productForUpdate = Product::factory()->definition();
        $productForUpdate['brand_id'] = $newBrand->id;
        $productForUpdate['city_id'] = $newCity->id;

        $response = $this->token()->put(uri: '/api/v1/products/' . $product->id, data: $productForUpdate);
        $response->assertStatus(status: 200);
        $response->assertJsonPath(path: "message", expect: trans(key: 'messages.products.updating_successfully'));
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => ['id', 'name', 'brand_id', 'stock', 'city_id', 'created_by', 'updated_by', 'created_at', 'updated_at'],
            'metadata'
        ]);

        foreach (['name', 'price', 'brand_id', 'stock', 'city_id'] as $field) {
            $response->assertJsonPath(path: "data.$field", expect: $productForUpdate[$field]);
        }
    }

    /**
     * Testando atualização de produto com erro quando enviamos id inexistente
     * Verifica um retorno com sucesso para o end point PUT /products/{id}
     *
     * @test
     */
    public function check_update_return_with_error(): void
    {
        Auth::login(User::factory()->create());
        $brand  = Brand::factory()->create();
        $city   = City::factory()->create();
        $newBrand  = Brand::factory()->create();
        $newCity   = City::factory()->create();

        $product = Product::factory()->create(['brand_id' => $brand->id, 'city_id' => $city->id,]);
        $productForUpdate = Product::factory()->definition();
        $productForUpdate['brand_id'] = $newBrand->id;
        $productForUpdate['city_id'] = $newCity->id;
        unset($productForUpdate['id']);

        $response = $this->token()->put(uri: '/api/v1/products/9999', data: $productForUpdate);
        $response->assertStatus(status: 400);
        $response->assertJsonPath(path: "message", expect: trans(key: 'messages.products.not_found'));
        $response->assertJsonStructure([
            'success',
            'message',
            'data',
        ]);
    }

    /**
     * Testando exclusão de produto
     * Verifica um retorno com sucesso para o end point DELETE /products/{id}
     *
     * @test
     */
    public function check_delete_return_with_success(): void
    {
        Auth::login(User::factory()->create());
        $brand  = Brand::factory()->create();
        $city   = City::factory()->create();

        $product = Product::factory()->create(['brand_id' => $brand->id, 'city_id' => $city->id, 'stock' => 0]);

        $response = $this->token()->delete(uri: '/api/v1/products/' . $product->id);
        $response->assertStatus(status: 200);
        $response->assertJsonPath(path: "message", expect: trans(key: 'messages.products.deleting_successfully'));
        $response->assertJsonStructure([
            'success',
            'message',
            'data',
            'metadata'
        ]);

        $this->assertNull(Product::find($product->id));
    }

    /**
     * Testando exclusão de produto com erro quando enviamos id inexistente
     * Verifica um retorno com sucesso para o end point DELETE /products/{id}
     *
     * @test
     */
    public function check_delete_return_with_error(): void
    {
        Auth::login(User::factory()->create());
        $brand  = Brand::factory()->create();
        $city   = City::factory()->create();

        $product = Product::factory()->create(['brand_id' => $brand->id, 'city_id' => $city->id,]);

        $response = $this->token()->delete(uri: '/api/v1/products/99999');
        $response->assertStatus(status: 400);
        $response->assertJsonPath(path: "message", expect: trans(key: 'messages.products.not_found'));
        $response->assertJsonStructure([
            'success',
            'message',
            'data',
        ]);
    }
}
