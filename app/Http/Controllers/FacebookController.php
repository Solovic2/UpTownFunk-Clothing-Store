<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirect(){

        if(session()->get('url') != null){
            session()->put('prev', session()->get('url')['intended']);
        }
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(){
        $user = Socialite::driver('facebook')->user();
        $isUser = User::where('email','=',$user->email)->first();
        $bool = false;
        if(! $isUser){
            $isUser = new User();
            $isUser->name = $user->name;
            $isUser->path = $user->avatar;
            $isUser->email = $user->email;
            $isUser->save();
            $bool = true;
        }
        Auth::login($isUser);
        if($bool){
            return redirect()->route('facebook.phone');
        }
        if(Session::has('prev')){
            $url = session()->pull('prev');
            return redirect($url);
        }else{
            return redirect()->route('home');
        }

    }
    public function phone(){
        return view('auth.facebook_phone');
    }

    public function store(Request $request){
        $user = User::find(Auth::id());
        $validate = $request->validate([
            'phone'=>'required|min:11|max:11',
            'password'=>'same:password|min:8|max:100'
        ]);
        $user->password =Hash::make($validate['password']);
        $user->phone = $validate['phone'];
        $user->save();
        return redirect()->route('verify.sendCode');
    }
}
