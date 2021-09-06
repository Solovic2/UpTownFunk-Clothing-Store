<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProductSizeQuantity extends Model
{
    use HasFactory;
    protected $table = 'user_product_size_quantity';
    protected $fillable = ['user_id','product_id','size_id','quantity','book_buy'];
    public function user(){
        return $this->belongsTo('App\Models\User') ;
    }
    public function product(){
        return $this->belongsTo('App\Models\Product') ;
    }
    public function size(){
        return $this->belongsTo('App\Models\Size') ;
    }
}
