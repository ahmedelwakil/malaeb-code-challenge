<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->admin()->create();
        User::factory(20)->user()->create();
        Category::factory(10)->has(Product::factory()->count(15))->create();
    }
}
