<?php

namespace Tests\Unit;

use App\Models\Brand;
use App\Models\City;
use App\Models\User;
use Tests\CreatesApplication;
use PHPUnit\Framework\TestCase;
use Illuminate\{Database\QueryException,
    Foundation\Testing\RefreshDatabase,
    Support\Facades\Artisan,
    Support\Facades\Auth};
use App\Models\Product;
use App\Actions\Products\{
    DeleteProduct,
    StoreProduct,
    UpdateProduct,
};


class ProductActionsTest extends TestCase
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

    public function test_store_product_successfully()
    {
        Auth::login(User::factory()->create());
        $product = Product::factory()->definition();
        $product['brand_id'] = Brand::factory()->create()->id;
        $product['city_id'] = City::factory()->create()->id;

        $storeProductAction = new StoreProduct();
        $createdProduct = $storeProductAction->handler(...$product);

        $this->assertInstanceOf(Product::class, $createdProduct);
        $this->assertEquals($product['name'], $createdProduct->name);
        $this->assertEquals($product['price'], $createdProduct->price);
        $this->assertEquals($product['brand_id'], $createdProduct->brand_id);
        $this->assertEquals($product['stock'], $createdProduct->stock);
        $this->assertEquals($product['city_id'], $createdProduct->city_id);
    }

    public function test_store_product_exception()
    {
        $product = [];
        $storeProductAction = new StoreProduct();

        $this->expectException(\Exception::class);

        $storeProductAction->handler(...$product);
    }

    public function test_update_product_successfully()
    {
        Auth::login(User::factory()->create());
        $product = Product::factory()->create([
            'brand_id' => Brand::factory()->create()->id,
            'city_id' => City::factory()->create()->id,
        ])->toArray();

        $product['name'] = fake()->name() . ' new name';
        $product['price'] = fake()->randomFloat(2, 1, 100);
        $product['city_id'] = Brand::factory()->create()->id;
        $product['stock'] = fake()->randomFloat(2, 1, 100);
        $product['brand_id'] = City::factory()->create()->id;

        $updateProductAction = new UpdateProduct();
        $updatedProduct = $updateProductAction->handler(...$product);

        $this->assertInstanceOf(Product::class, $updatedProduct);
        $this->assertEquals($product['name'], $updatedProduct->name);
        $this->assertEquals($product['price'], $updatedProduct->price);
        $this->assertEquals($product['city_id'], $updatedProduct->city_id);
        $this->assertEquals($product['stock'], $updatedProduct->stock);
        $this->assertEquals($product['brand_id'], $updatedProduct->brand_id);
    }

    public function test_update_product_exception()
    {
        Auth::login(User::factory()->create());
        $product = Product::factory()->create([
            'brand_id' => Brand::factory()->create()->id,
            'city_id' => City::factory()->create()->id,
        ])->toArray();
        unset($product['id']);
        $updateProductAction = new UpdateProduct();

        $this->expectException(\Exception::class);

        $updateProductAction->handler(...$product);
    }

    public function test_delete_product_successfully()
    {
        Auth::login(User::factory()->create());
        $product = Product::factory()->create([
            'brand_id' => Brand::factory()->create()->id,
            'city_id' => City::factory()->create()->id,
            'stock' => 0
        ])->toArray();

        $deleteProductAction = new DeleteProduct();
        $deleteProductAction->handler(...$product);

        $this->assertFalse(Product::where('id', $product['id'])->exists());
    }

    public function test_delete_product_error_with_stock()
    {
        Auth::login(User::factory()->create());
        $product = Product::factory()->create([
            'brand_id' => Brand::factory()->create()->id,
            'city_id' => City::factory()->create()->id,
            'stock' => 100
        ])->toArray();

        $deleteProductAction = new DeleteProduct();

        $this->expectException(\Exception::class);
        $deleteProductAction->handler(...$product);
    }

    public function test_delete_product_exception()
    {
        Auth::login(User::factory()->create());
        $product = Product::factory([
            'brand_id' => Brand::factory()->create()->id,
            'city_id' => City::factory()->create()->id,
        ])->create()->toArray();
        unset($product['id']);

        $deleteProductAction = new DeleteProduct();

        $this->expectException(\Exception::class);
        $deleteProductAction->handler(...$product);
    }
}
