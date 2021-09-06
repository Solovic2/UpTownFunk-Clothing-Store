<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = ['name','type','price','max_no_product','category_id'];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
    public function sizes(){
        return $this->belongsToMany('App\Models\Size')->withPivot(['id','length','width','depth','quantity']);
    }

    function relations() {
        return $this->hasMany(UserProductSizeQuantity::class)->with('user','size');
     }

    public function images(){
        return $this->hasMany('App\Models\Image');
    }
}
