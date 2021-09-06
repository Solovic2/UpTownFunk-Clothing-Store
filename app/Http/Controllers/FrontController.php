<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserProductSizeQuantity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent as AgentAgent;

class FrontController extends Controller
{
    public function index(){
        $jacket = Category::with('products')->where('type','=','Jackets')->first();
        $shirts = Category::with('products')->where('type','=','Shirts')->first();
        $jacketProduct = $jacket->products()->with('images')->get();
        $shirtsProduct = $shirts->products()->with('images')->get();

        return view('welcome',['jackets'=>$jacketProduct,'shirts'=>$shirtsProduct,'agent'=> new AgentAgent() ]);
    }

    public function show($id)
    {
       $product = Product::with(['images','sizes'])->findOrFail($id);
       $user = null;
        if( Auth::check() ){
            $user = Auth::user()->relations->where('product_id','=', $product->id);
            $booked = count($user->where('book_buy','=',1));
        }
        return view('front.show',['product'=>$product,'user'=>$user,'booked'=>$booked]);
    }

    public function showCategory ($id){
        $cats = Category::all();
        return view('front.category-show',['categories'=>Category::with('products')->findOrFail($id),'cats'=>$cats]);
    }

    public function completeData(Request $request,$id)
    {
        $validate  = $request->validate([
            'quantity' =>'bail|required|min:1|max:1000|numeric'
            
        ]);
        if($request->input('available') >= $validate['quantity']){
            
            $product = Product::findOrFail($id);
            if(!session()->has('quantity') )
            {
                session()->put('quantity',$validate['quantity']) ;
            }
            if(!session()->has('size')){
                session()->put('size',$request->input('size')) ;
            }

            return redirect()->route('category.showMoreDetails',$product->id) ;
        }
        else{
            return redirect()->back()->with('error' ,'Max quantity you should take is ' . $request->input("available") . '');
        }
    }
    public function showMoreDetails($id)
    {
        return view('front.completeData',['id'=>$id]);
    }

    public function storeDetails(Request $request , $id)
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

        return redirect()->route('category.buyOrBook',$id);
    }

    public function buyOrBook($id)
    {
        return view('front.showPayment',['id'=>$id]);
    }

    public function book($id)
    {

            $product = Product::with('sizes')->findOrFail($id);
            $book =  UserProductSizeQuantity::create([
                'user_id'=> Auth::id(),
                'product_id'=> $product->id,
                'size_id' => session()->pull('size'),
                'quantity'=>  session()->pull('quantity'),
                'book_buy'=> 1 ,
            ]);
            $pivot = $product->sizes->find($book->size_id);
            $pivot->pivot->quantity -= $book->quantity;
            $pivot->pivot->save();
            return redirect()->route('product.show',$product->id);
    }
}
