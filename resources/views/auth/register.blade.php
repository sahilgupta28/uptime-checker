@extends('layouts.app')

@section('content')

<div class="mx-auto h-full justify-center items-center flex bg-gray-300">
    <div class="w-96 bg-blue-900 rounded-lg shadow-xl p-6">
        <h1 class="text-white text-3xl pt-8">{{ env('APP_NAME') }}</h1>
        <h2 class="text-blue-300">Enter your details to create a free account.</h2>
         <form method="POST" action="{{ route('register') }}" class="pt-8">
            @csrf

            <div class="relative">
                <label for="name" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-2">{{ __('Name') }}</label>
                <div>
                    <input id="name" type="text" class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="John Doe">
                    @error('name')
                        <span class="text-red-500 text-sm" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="relative pt-3">
                <label for="email" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-2">{{ __('E-Mail Address') }}</label>
                <div>
                    <input id="email" type="email" class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="your@email.com">
                    @error('email')
                        <span class="text-red-500 text-sm" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="relative pt-3">
                <label for="password" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-2">{{ __('Password') }}</label>
                <div>
                    <input id="password" type="password" class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700" name="password" required autocomplete="new-password" placeholder="secret">
                    @error('password')
                        <span class="text-red-500 text-sm" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="relative pt-3">
                <label for="password-confirm" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-2">{{ __('Confirm Password') }}</label>
                <div>
                    <input id="password-confirm" type="password" class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700" name="password_confirmation" required autocomplete="new-password" placeholder="secret">
                </div>
            </div>
            <div class="pt-8">
                <button type="submit" class="uppercase rounded text-gray-100 w-full bg-gray-400 py-2 px-3 text-left text-blue-800">{{ __('Register') }}</button>
            </div>

            <div class="flex pt-8 justify-end text-white text-sm font-bold">
                <a href="{{ route('login') }}">Already a member?</a>
            </div>
        </form>
    </div>
</div>

@endsection
