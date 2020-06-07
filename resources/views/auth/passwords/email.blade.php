@extends('layouts.app')

@section('content')
<div class="mx-auto h-full justify-center items-center flex bg-gray-300">
    <div class="w-96 bg-blue-900 rounded-lg shadow-xl p-6">
        <h1 class="text-white text-3xl pt-8">{{ env('APP_NAME') }}</h1>
        <h2 class="text-blue-300">Don't worry. Resetting your password is easy, just tell us the email address you registered with us.</h2>
        <form method="POST" action="{{ route('password.email') }}" class="pt-8">
            @csrf
            <div class="relative">
                <label for="email" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-2">{{ __('E-Mail Address') }}</label>
                <div>
                    <input id="email" type="email" class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="your@email.com">
                    @error('email')
                        <span class="text-red-500 text-sm" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="pt-8">
                <button type="submit" class="uppercase rounded text-gray-100 w-full bg-gray-400 py-2 px-3 text-left text-blue-800">{{ __('Send Password Reset Link') }}</button>
            </div>

            <div class="flex justify-between pt-8 text-white text-sm font-bold">
                <a class="" href="{{ route('register') }}">{{ __('Register') }}</a>
                <a class="" href="{{ route('login') }}">{{ __('Login') }}</a>
            </div>

        </form>
    </div>
</div>
@endsection
