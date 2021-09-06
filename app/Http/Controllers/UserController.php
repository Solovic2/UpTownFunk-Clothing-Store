<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserProductSizeQuantity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','checkPhone','phoneVerify']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with('details')->find(Auth::id());
        return view('user.profile',['user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.add-details');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'address'=>'required|string',
            'country'=>'required|string',
            'department'=>'required|numeric|min:0|max:500',
            'tower'=>'required|min:1',
            'floor'=>'required|numeric|min:0|max:100',
        ]);

        $details = new UserDetail();
        $details->fill($validate);
        $details->fill(['user_id'=>Auth::id()]);
        $details->save();

        $user = User::find(Auth::id());
        $user->detailed = 1;
        $user->save();
        return redirect()->route('profile.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('details')->findOrFail($id);
        return view('user.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' =>'required|string',
        ]);
        $psValidation = $request->validate([
            'password'=> 'same:password|max:100',
        ]);
        $user = User::findOrFail($id);
        // check and save details 
        if($user->details != null){
            $details =$request->validate([
                'address'=>'required|string',
                'country'=>'required|string',
                'department'=>'required|numeric|min:0|max:500',
                'tower'=>'required|min:1',
                'floor'=>'required|numeric|min:0|max:100',
            ]);
            $user->details->fill($details);
            $user->details->save();
        }
        $user->fill($validate);
        // check image
        $hasFile = $request->hasFile('image');
        if($hasFile){
           $file = $request->file('image');
           $path =  $file->storeAs('profile_pictures', $user->id . '.' . $file->guessExtension() );
           $user->path = $path;
        }
        // check password
        if($request->input('password')){
            $user->password = Hash::make($psValidation['password']);
        }
        $user->save();
        return redirect()->route('profile.index');
    }

    public function products($id){
        // booked ? 
        $userProducts  = User::with('relations')->findOrFail($id);
        return view('user.products',['relations'=>$userProducts->relations]);
    }
    public function destoryProduct($id)
    {
        
        $relation = UserProductSizeQuantity::with(['product','size'])->findOrFail($id);
        $product = Product::with('sizes')->find($relation->product->id);
        $pivot = $product->sizes->find($relation->size_id);
        $pivot->pivot->quantity +=  $relation->quantity;
        $pivot->pivot->save();
        $relation->delete();
        return redirect()->back()->withStatus('User Product Deleted Successful !');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
    }
}
