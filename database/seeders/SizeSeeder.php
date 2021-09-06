<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = collect(['M','L','xL','2xL','3xL','4xL','5xL','6xL']);
        $sizes->each(function ($sizeName){
            Size::create(['size'=>$sizeName]);
        });
    }
}
