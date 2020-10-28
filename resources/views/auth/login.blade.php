@extends('layouts.app')

@section('content')
<div class="mx-auto h-full justify-center items-center flex bg-gray-300">
    <div class="w-96 bg-blue-900 rounded-lg shadow-xl p-6">
        <h1 class="text-white text-3xl pt-8">{{ env('APP_NAME') }}</h1>
        @include('auth.social_login')
        <h2 class="text-blue-300">Enter your credentials below.</h2>
         <form method="POST" action="{{ route('login') }}" class="pt-8">
            @csrf

            <div class="relative">
                <label for="email" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-2">{{ __('E-Mail') }}</label>
                <div>
                    <input id="email" type="email" class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700" name="email" value="{{ old('email') }}" required autofocus placeholder="your@email.com">
                    @error('email')
                        <span class="text-red-500 text-sm" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="relative pt-3">
                <label for="password" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-2">{{ __('Password') }}</label>
                <div>
                    <input id="password" type="password" class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700" name="password" required autocomplete="current-password" placeholder="secret">
                    @error('password')
                        <span class="text-red-500 text-sm" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="relative pt-3">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="text-white" for="remember">{{ __('Remember Me') }}</label>
                    </div>
                </div>
            </div>

            <div class="pt-8">
                <button type="submit" class="uppercase rounded text-gray-100 w-full bg-gray-400 py-2 px-3 text-left text-blue-800">{{ __('Login') }}</button>
            </div>

            <div class="flex justify-between pt-8 text-white text-sm font-bold">
                <a class="" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                <a class="" href="{{ route('register') }}">{{ __('Register') }}</a>
            </div>
        </form>
    </div>
</div>
@endsection
