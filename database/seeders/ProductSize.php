<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Seeder;

class ProductSize extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Product::all()->each(function($product){
            $size = Size::inRandomOrder()->take(2)->get()->pluck('id');
            $product->sizes()->attach($size,['length'=>'14.5','width'=>'12.2','depth'=>'5.2']);
        });
    }
}
