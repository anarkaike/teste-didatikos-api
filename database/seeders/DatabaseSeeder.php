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

        $brands = Brand::factory(count: 12)->create();
        $cities = City::factory(count: 12)->create();

        for ($i=0; $i < 30; $i++) {
            if ($i >=0 && $i < 10) {
                Product::factory()->create(attributes: [
                    'brand_id'      => $brands[rand(0, 3)]->id,
                    'city_id'       => $cities[rand(0, 3)]->id,
                    'created_by'    => $user->id,
                ]);
            }
            if ($i >=11 && $i < 20) {
                Product::factory()->create(attributes: [
                    'brand_id'      => $brands[rand(4, 7)]->id,
                    'city_id'       => $cities[rand(4, 7)]->id,
                    'created_by'    => $user->id,
                ]);
            }
            if ($i >=20 && $i < 30) {
                Product::factory()->create(attributes: [
                    'brand_id'      => $brands[rand(8, 11)]->id,
                    'city_id'       => $cities[rand(8, 11)]->id,
                    'created_by'    => $user->id,
                ]);
            }
        }
    }
}
