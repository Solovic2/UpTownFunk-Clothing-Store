@extends('layouts.main',['fixed'=>'fixed-bottom'])

@section('content')
<div class="container  mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(Session::has('status'))
            <div class="mb-3 text-center">
                <span class="alert alert-info animate__animated animate__pulse font-weight-bold ">{{ session()->get('status') }}</span>
            </div>
            @endif
            @if(Session::has('invalid'))
            <div class="mb-3 text-center">
                <span class="alert alert-danger animate__animated animate__pulse font-weight-bold ">{{ session()->get('invalid') }}</span>
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    {{ __('Verify Your Phone Number') }}

                </div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification number has been sent to your email address.') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('verify.phone.send') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <input class="form-control" type="text" name="verify" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <button type="submit" class="btn btn-primary">Verify</button>
                            </div>
                        </div>
                    </form>
                    {{ __('Before proceeding, please check your phone for a verification number') }}
                    <span>, It might take <strong id="timeLeft">5 seconds </strong> </span><br>
                    {{ __('If you did not receive the code') }},
                     <button id="display" class="btn btn-link p-0 m-0 align-baseline" disabled>
                            <a href="{{ route('verify.sendCode') }}">{{ __('click here to request another') }}</a>.
                    </button>
                    <form method="POST" action="{{ route('verify.reRegister') }}">
                        @csrf
                        @method('delete')
                        <span> Your Phone Number isn't correct ? </span>
                        <button type="submit" class="btn btn-link p-0 m-0 text-danger">try register again</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    setTimeout (function(){
    document.getElementById('display').disabled = null;
    },5000);

    var countdownNum = 5;
    incTimer();

function incTimer(){
    setTimeout (function(){
        if(countdownNum != 0){
            countdownNum--;
            document.getElementById('timeLeft').innerHTML = '' + countdownNum + ' seconds';
        incTimer();
        } else {
            document.getElementById('timeLeft').innerHTML = 'Ready!';
        }
    },1000);
}
</script>
