<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CodeVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

use function PHPUnit\Framework\isEmpty;

class VerifyPhoneController extends Controller
{
    public function index(){
        return view('auth.verify_phone');
    }
    public function sendCode(){
        //random number
        $code = random_int(100000,999999);

        // save in db and sending code
        $user = User::with('code')->findOrFail(Auth::id());
        $sms = Http::get('https://eg.apisms.link/api/points',['username'=>env('VERIFY_PHONE_USERNAME'),'password'=>env('VERIFY_PHONE_PASSWORD')]);
        // $sms= Http::get('https://eg.apisms.link/api/send',
        //                  ['username'=>env('VERIFY_PHONE_USERNAME'),'password'=>env('VERIFY_PHONE_PASSWORD'),
        //                  'sendername'=>env('VERIFY_PHONE_SENDER'),'mobiles'=> '2' . Auth::user()->phone,'message'=>'Code is : ' . $code . ' ']);
        if($sms['status'] == 'error'){
            $user->delete();
            return redirect()->route('register')->with(['failed'=>'Failed to send verification code to ur phone number , try again']);
        }
        if($user->code === null ){
            $verify = new CodeVerification();
            $verify->code= $code;
            $verify->status = $sms['status'];
            $user->code()->save($verify);
        }else{
            $user->code()->update(['code'=>$code,'status'=>$sms['status']]) ;
        }

        $status = 'Code Is Sended !';
        if (URL::previous() === route('verify.phone')){
            $status = 'Code Resended Again ';
        }

        return redirect()->route('verify.phone')->withStatus($status);
    }
    public function verify(Request $request){
        $request->validate([
                'verify'=>'required|numeric',
        ]);
        if($request->input('verify') != Auth::user()->code->code ){
            return redirect()->back()->with(['invalid'=>'Code is Not Correct']);
        }
        $user = User::findOrFail(Auth::id());
        $user->phone_verified = 1;
        $user->save();
        if($request->session()->has('prev')){
            $url = $request->session()->pull('prev');
            return redirect($url);

        }
        else{
            return redirect()->route('home');
        }
        
    }

    public function reRegister(){
        $user = User::findOrFail(Auth::id());
        $user->delete();
        return redirect()->route('register');
    }
}
