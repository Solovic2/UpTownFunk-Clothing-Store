<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;
use App\Models\User;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cats = Category::inRandomOrder()->get();
        Product::factory(App\Models\Product::class)->count(30)->make()->each(function($product)use ($cats){
            $product->category_id = $cats->random()->id;
            $product->save();
        });

    }
}
