<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::where('is_admin','=','1')->get()->first();

        $cats = collect(['Shirts','Jackets','Jeba','Pantalon','Hats']);
        $cats->each(function ($cat)use($admin){
            Category::create(['type'=>$cat , 'user_id'=>$admin->id]);
        });
    }
}
