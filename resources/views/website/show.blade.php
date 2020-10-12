@extends('layouts.app')

@section('content')
<div class="h-full">
<div class="w-full mt-4 bg-blue-900 px-6 py-3">
    <h3 class="text-white text-3xl">Edit Website Info</h3>
    <form class="w-full py-3" method="POST" action="{{ route('website.update', $website->id) }}">
        @csrf
        {{ method_field('PUT') }}
        <div class="flex flex-wrap -mx-3">
            <div class="w-full md:w-3/4 px-3">
            <label 
                for="title" 
                class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" 
                >
                Title
            </label>
            <input 
                class="appearance-none block w-full bg-gray-300 text-gray-700 border border-gray-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"  
                type="text" 
                placeholder="Eg: John" 
                id="title" 
                type="text"  
                name="title"  
                autocomplete="current-title" 
                value="{{ old('title', $website->title) }}"
                autofocus
            >
            @error('title')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
            </div>

            <div class="w-full md:w-3/4  px-3">
            <label 
                for="domain" 
                class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" 
                >
                Domain
            </label>
            <input 
                class="appearance-none block w-full bg-gray-300 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                id="domain"
                name="domain" 
                type="text" 
                class="form-control" 
                value="{{ old('domain', $website->domain) }}" 
                autocomplete="domain" 
                placeholder="Eg: google.com"
            >
            @error('domain')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
            </div>

            <div class="w-full md:w-3/4  px-3">
            <label 
                for="slack_hook" 
                class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" 
                >
                Slack Hook
            </label>
            <input 
                class="appearance-none block w-full bg-gray-300 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                id="slack_hook"
                name="slack_hook"
                type="text" 
                class="form-control" 
                value="{{ old('slack_hook', $website->slack_hook) }}" 
                autocomplete="slack_hook" 
                placeholder=""
            >
            @error('slack_hook')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
            </div>

            <div class="w-full md:w-3/4  px-3">
            <label 
                for="description" 
                class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2"     
            >
                Description
            </label>
            <textarea 
                id="description" 
                type="text" 
                class="appearance-none block w-full bg-gray-300 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                name="description" 
                rows="3" 
                placeholder="Write something about you..."
                >{{ old('description', $website->description) }}</textarea>
            @error('description')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
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