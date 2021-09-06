<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProductRequest;
use App\Http\Requests\SizeRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Agent\Facades\Agent;

class AdminProductsController extends Controller
{
    /**
     * Display a listing of
     *-> the resourc
     * @return \Illuminate\Http\Response
     */
    public function index($cat)
    {
        $myCat = Category::with('products')->findOrFail($cat);
        return view('admin.products.index',['products'=> $myCat->products()->with('sizes')->latest()->paginate(9),'catID'=>$myCat->id]);

    }
    // public function show($cat)
    // {   $myCat = Category::with('products')->findOrFail($cat);
    //     return view('admin.products.index',['products'=> $myCat->products()->with('sizes')->latest()->paginate(9),'catID'=>$myCat->id]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($cat)
    {

        return view('admin.products.create',['catID'=>$cat]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminProductRequest $request,$cat)
    {
        $validated = $request->validated();
        $product = new Product();
        $product->fill($validated);
        $product->fill(['category_id'=>$cat]);
        $product->save();
        if($request->hasFile('img')){
            $files = $request->file('img');
            foreach($files as $file){
               $path = $file->store($product->id);
               $img = new Image();
               $img->path = $path;
               $product->images()->save($img);
            }
        }

        return redirect()->route('admin.products.index',$cat)->with(['add'=>'Adding New Product Successful !']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cat,$id)
    {
        return view('admin.products.edit',['product'=>Product::findOrFail($id),'catID'=>$cat]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminProductRequest $request, $cat,$id)
    {
        $product = Product::findOrFail($id);
        $validate = $request->validated();
        $product->fill($validate);
        $product->save();
        return redirect()->route('admin.products.index',$cat)->with(['upload'=>'Uploaded Successful!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cat,$id)
    {
        $product = Product::with('images')->find($id);
        foreach($product->images as $image){
            Storage::delete($image->path);
        }
        Product::destroy($id);
        return redirect()->back()->withStatus('Product Deleted Successful !');
    }


 /*** Pictures ****/
    public function showPictures($id){
        $product = Product::with('images')->findOrFail($id);
        return view('admin.products.pictures_index',['product'=>$product]);
    }

    public function updatePictures(Request $request , $id){
        $hasFile = $request->hasFile('new-img');
        $product = Product::findOrFail($id);
        if($hasFile){
            $file = $request->file('new-img');
            $path = $file->store($product->id);
            $img = new Image();
            $img->path = $path;
            $product->images()->save($img);
        }

        return redirect()->back()->with(['img'=>'Uploaded Successful!']);
    }
    
    public function deleteProduct($id,$image){
        $img = Image::findOrFail($image);
        Storage::delete($img->path);
        $img->delete();
        return redirect()->back()->with(['img'=>'Deleted Successful']);
    }

    /** Sizes */
    public function showSizes($id){
        $product = Product::with('sizes')->findOrFail($id);
        return view('admin.products.sizes_index',['product'=>$product]);

    }
    public function createSizes($id){
        $product = Product::with('sizes')->findOrFail($id);
        $sizes = Size::whereNotIn('id',$product->sizes->pluck('id'))->get() ;
        return view('admin.products.sizes_create',['id'=>$product->id,'sizes'=>$sizes]);
    }
    public function storeSizes(SizeRequest $request,$id){
        $product = Product::findOrFail($id);
        $validate = $request->validated();
        $product->sizes()->attach($request->input('size'),$validate);
        return redirect()->route('admin.products.showSizes',$id)->with(['add'=>'Added Successful !']);
    }
    public function editSizes($id,$size){
        $product = Product::with('sizes')->findOrFail($id);
        $available = Size::whereNotIn('id',$product->sizes->pluck('id'))->get();
        $sizes = $product->sizes->where('id','=',$size) ;
        return view('admin.products.sizes_edit',['id'=>$product->id ,'size'=>$size ,'sizes'=>$sizes,'available'=>$available]);
    }
    public function updateSizes(SizeRequest $request,$id,$size){
        $product = Product::findOrFail($id);
        $validate = $request->validated();
        $product->sizes()->updateExistingPivot($size,['size_id'=>$request->input('size')]);
        $product->sizes()->updateExistingPivot($request->input('size'),$validate);
        return redirect()->route('admin.products.showSizes',$id)->with(['upload'=>'Uploaded Successful !']);
    }
    public function destroySizes($id,$size){
        $product = Product::findOrFail($id);
        $product->sizes()->detach($size);
        return redirect()->route('admin.products.showSizes',$product->id)->withStatus('Deleted Successful !');

    }

}
