<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;
    protected $table = 'user_details';
    protected $fillable = ['address','country','tower','department','floor','user_id'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
