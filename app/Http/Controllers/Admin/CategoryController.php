<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(){
        
        return view('admin.cats.index',['cats'=>Category::paginate(9)]);
    }
    public function create()
    {
         return view('admin.cats.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([ 'type'=>'required' ]); 
        Category::create(['type'=>$validated['type'],'user_id'=>Auth::id()]);
         return redirect()->route('admin.categories.index')->with(['add'=>'Added Successful !']);
    }
    public function edit($id)
    {
        return view('admin.cats.edit',['cat'=>Category::findOrFail($id)]);

    }
    public function show($id){
        $cat = Category::with('products')->findOrFail($id);
        return view('admin.products.index',['products'=> $cat->products()->with('sizes')->latest()->paginate(9),'catID'=>$cat->id]);
    }
    public function update(Request $request,$id)
    {
        $request->validate(['type'=>'required']);
        $cat = Category::find($id);
        $cat->fill(['type'=>$request->input('type')]);
        $cat->save();

        return redirect()->route('admin.categories.index')->with(['upload'=>'Category Updated Successful !']);

    }
    public function destroy($id){
        $cat = Category::with('products')->findOrFail($id);
        foreach($cat->products as $product){
            foreach($product->images as $image){
                Storage::delete($image->path);
            }
        }
        Category::destroy($id);
        return redirect()->back()->withStatus('Category Deleted Successful !');
    }
}
