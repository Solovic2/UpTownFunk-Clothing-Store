<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserRequest;
use App\Models\Product;
use App\Models\User;
use App\Models\UserProductSizeQuantity;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::withCount('relations')->where('is_admin','!=','1')->latest()->paginate(9);
        return view('admin.users.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserRequest $request)
    {
        $user = new User();
        $validated = $request->validated();
        $user->fill($validated);
        $user->fill(['password'=>Hash::make($request->input('password'))]);
        $user->save();

        return redirect()->route('admin.users.index')->with(['add'=>'Adding New User Successful !']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.users.edit',['user'=>User::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $validate = $request->validated();
        $user->fill($validate);
        $hasFile = $request->hasFile('image');
        if($hasFile){
           $file = $request->file('image');
           $path =  $file->storeAs('profile_pictures', $user->id . '.' . $file->guessExtension() );
           $user->path = $path;
        }
        $user->save();
        return redirect()->back()->withStatus('Uploaded Successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user->path != "profile_pictures/avatar.png"){
            Storage::delete($user->path) ;
        }
        User::destroy($id);
        return redirect()->back()->withStatus('User Deleted Successful !');
    }

    /// Users Products
    public function showProducts($id){
        $userProducts = User::with('relations')->findOrFail($id);
        return view('admin.users.products_index',['relations'=>$userProducts->relations,'user_name'=>$userProducts->name,'id'=>$userProducts->id]);
    }
    public function showProductPictures($id,$product_id){
        $product = Product::with('images')->findOrFail($product_id);
        return view('admin.users.products_image',['user_id'=>$id,'product'=>$product]);
    }
    public function destroyProduct($id,$relationID){
        $relation = UserProductSizeQuantity::with(['product','size'])->findOrFail($relationID);
        $product = Product::with('sizes')->find($relation->product->id);
        $pivot = $product->sizes->find($relation->size_id);
        $pivot->pivot->quantity +=  $relation->quantity;
        $pivot->pivot->save();
        $relation->delete();
        return redirect()->back()->withStatus('User Product Deleted Successful !');
    }

}
