<div class="w-full mt-4 bg-blue-900 px-6 py-3">
    <h3 class="text-white text-3xl">Enter a new Website.</h3>
    <form class="w-full py-3" method="POST" action="{{ route('website.create') }}">
        @csrf
        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
        <div class="flex flex-wrap -mx-3">
            <div class="w-full md:w-1/5 px-3 mb-6 md:mb-0">
            <label for="title" class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-first-name">
                Title
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Google" id="title" type="text"  name="title"  autocomplete="current-title" value="{{ old('title') }}">
            @error('title')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
            </div>

            <div class="w-full md:w-1/5 px-3">
            <label for="domain" class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-last-name">
                Domain
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" id="domain" type="text" class="form-control @error('domain') is-invalid @enderror" name="domain" value="{{ old('domain') }}" autocomplete="domain" autofocus placeholder="www.google.com">
            @error('domain')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
            </div>

            <div class="w-full md:w-2/5 px-3">
            <label for="description" class="block uppercase tracking-wide text-gray-500 text-xs font-bold mb-2" for="grid-last-name">
                Description
            </label>
            <textarea id="Description" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="description" rows="1" placeholder="Say Soemthing...">{{ old('description') }}</textarea>
            @error('description')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
            </div>

            <div class="w-full md:w-1/5 px-3 mt-6">
            <button type="submit" class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">SAVE</button>
            </div>
        </div>
    </form>
</div>