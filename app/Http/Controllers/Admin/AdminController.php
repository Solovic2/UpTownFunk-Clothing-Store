<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserProductSizeQuantity;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }
    public function showOrders()
    {
       $relation = UserProductSizeQuantity::with(['user','product','size'])->where('book_buy','=',1)->latest()->paginate(9);
       return view('admin.showOrders',['relations'=>$relation]);
    }
}
