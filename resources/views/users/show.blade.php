@extends('layouts.app')

@section('content')
<div class="h-full">
<div class="w-full mt-4 bg-blue-900 px-6 py-3">
    <h3 class="text-white text-3xl">Edit User Profile</h3>
    <form class="w-full py-3" method="POST" action="{{ route('user.update', auth()->user()->id) }}">
        @csrf
        {{ method_field('PUT') }}
        <div class="flex flex-wrap -mx-3">
            <div class="w-full md:w-3/4 px-3">
            <label 
                for="name" 
                class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" 
                >
                Name
            </label>
            <input 
                class="appearance-none block w-full bg-gray-300 text-gray-700 border border-gray-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"  
                type="text" 
                placeholder="Eg: John" 
                id="name" 
                type="text"  
                name="name"  
                autocomplete="current-title" 
                value="{{ old('name', $user->name) }}"
                autofocus
            >
            @error('name')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
            </div>

            <div class="w-full md:w-3/4  px-3">
            <label 
                for="email" 
                class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" 
                >
                Email
            </label>
            <input 
                class="appearance-none block w-full bg-gray-300 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                id="email" 
                type="text" 
                class="form-control" 
                value="{{ old('email', $user->email) }}" 
                autocomplete="email" 
                placeholder="Eg: my@email.com"
                readonly
            >
            @error('email')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
            </div>

            <div class="w-full md:w-3/4  px-3">
            <label 
                for="bio" 
                class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2"     
            >
                Bio
            </label>
            <textarea 
                id="bio" 
                type="text" 
                class="appearance-none block w-full bg-gray-300 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                name="bio" 
                rows="3" 
                placeholder="Write something about you..."
                >{{ old('bio', $user->bio) }}</textarea>
            @error('bio')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
            </div>

            <div class="md:w-2/6  px-3 mt-6">
            <a 
                type="button" 
                class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                href = "{{ route('home') }}"
            >
                Back
            </a>
            <button 
                type="submit" 
                class=" md:w-2/6 shadow bg-indigo-500 hover:bg-indigo-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
            >
                UPADTE
            </button>
            </div>
        </div>
    </form>
</div>

@endsection