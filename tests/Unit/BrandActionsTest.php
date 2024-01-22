<?php

namespace Tests\Unit;

use Tests\CreatesApplication;
use PHPUnit\Framework\TestCase;
use Illuminate\{
    Foundation\Testing\RefreshDatabase,
    Support\Facades\Artisan,
};
use App\Models\Brand;
use App\Actions\Brands\{
    DeleteBrand,
    StoreBrand,
    UpdateBrand,
};


class BrandActionsTest extends TestCase
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

    public function test_store_brand_successfully()
    {
        $brand = Brand::factory()->definition();

        $storeBrandAction = new StoreBrand();
        $createdBrand = $storeBrandAction->handler(...$brand);

        $this->assertInstanceOf(Brand::class, $createdBrand);
        $this->assertEquals($brand['name'], $createdBrand->name);
        $this->assertEquals($brand['manufacturer'], $createdBrand->manufacturer);
    }

    public function test_store_brand_exception()
    {
        $brand = [];
        $storeBrandAction = new StoreBrand();

        $this->expectException(\Exception::class);

        $storeBrandAction->handler(...$brand);
    }

    public function test_update_brand_successfully()
    {
        $brand = Brand::factory()->create()->toArray();

        $brand['name'] = fake()->name() . ' new name';
        $brand['manufacturer'] = fake()->name() . ' new manufacturer';

        $updateBrandAction = new UpdateBrand();
        $updatedBrand = $updateBrandAction->handler(...$brand);

        $this->assertInstanceOf(Brand::class, $updatedBrand);
        $this->assertEquals($brand['name'], $updatedBrand->name);
        $this->assertEquals($brand['manufacturer'], $updatedBrand->manufacturer);
    }

    public function test_update_brand_exception()
    {
        $brand = Brand::factory()->create()->toArray();
        unset($brand['id']);
        $updateBrandAction = new UpdateBrand();

        $this->expectException(\Exception::class);

        $updateBrandAction->handler(...$brand);
    }

    public function test_delete_brand_successfully()
    {
        $brand = Brand::factory()->create()->toArray();

        $deleteBrandAction = new DeleteBrand();
        $deleteBrandAction->handler(...$brand);

        $this->assertFalse(Brand::where('id', $brand['id'])->exists());
    }

    public function test_delete_brand_exception()
    {
        $brand = Brand::factory()->create()->toArray();
        unset($brand['id']);

        $deleteBrandAction = new DeleteBrand();

        $this->expectException(\Exception::class);
        $deleteBrandAction->handler(...$brand);
    }
}
