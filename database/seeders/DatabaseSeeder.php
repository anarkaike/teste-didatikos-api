<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brand;
use App\Models\City;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user   = User::factory()->create();
        Auth::login(user: $user);

        $brands = Brand::factory(count: 30)->create();
        $cities = City::factory(count: 30)->create();

        for ($i=0; $i < 150; $i++) {
            if ($i >= 0 && $i < 50) {
                Product::factory()->create(attributes: [
                    'brand_id'      => $brands[rand(0, 9)]->id,
                    'city_id'       => $cities[rand(0, 9)]->id,
                    'created_by'    => $user->id,
                ]);
            }
            if ($i >=51 && $i < 100) {
                Product::factory()->create(attributes: [
                    'brand_id'      => $brands[rand(10, 19)]->id,
                    'city_id'       => $cities[rand(10, 19)]->id,
                    'created_by'    => $user->id,
                ]);
            }
            if ($i >=101 && $i < 150 ) {
                Product::factory()->create(attributes: [
                    'brand_id'      => $brands[rand(20, 29)]->id,
                    'city_id'       => $cities[rand(8, 29)]->id,
                    'created_by'    => $user->id,
                ]);
            }
        }
    }
}
