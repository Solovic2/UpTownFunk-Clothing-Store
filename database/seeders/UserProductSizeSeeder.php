<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Size;
use App\Models\User;
use App\Models\UserProductSizeQuantity;
use Illuminate\Database\Seeder;

class UserProductSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('is_admin','!=','1')->inRandomOrder()->get();
        $product =Product::inRandomOrder()->get();
        $size = Size::inRandomOrder()->get();
        UserProductSizeQuantity::factory(App\Models\UserProductSizeQuantity::class)->count(30)->make()->each(function($quantity)use($user,$product,$size){
            $quantity->user_id = $user->random()->id;
            $quantity->size_id = $size->random()->id;
            $quantity->product_id = $product->random()->id;
            $quantity->quantity = $product->random()->sizes->random()->pivot->quantity;
            $quantity->save();
        });
    }
}
