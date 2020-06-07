 <header>
    <nav class="flex items-center justify-between flex-wrap bg-blue-900 p-6">
        <div class="flex items-center flex-shrink-0 text-white mr-6">
            <span class="font-semibold text-xl tracking-tight">{{ env('APP_NAME') }}</span>
        </div>
        <div class="block lg:hidden">
            <button class="flex items-center px-3 py-2 border rounded text-blue-300 border-blue-800 hover:text-white hover:border-white">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
            </button>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center justify-end lg:w-auto">
            @guest
                <a href="{{ route('login') }}" class="block mt-4 lg:inline-block lg:mt-0 text-blue-300 hover:text-white mr-4">
                    Login
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="block mt-4 lg:inline-block lg:mt-0 text-blue-300 hover:text-white mr-4">
                    Register
                    </a>
                @endif
            @else
                <a href="#" class="block mt-4 lg:inline-block lg:mt-0 text-blue-300 hover:text-white mr-4">
                    {{ Auth::user()->name }}
                </a>
                <a href="{ route('logout') }}" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-blue-500 hover:bg-white mt-4 lg:mt-0" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            @endguest
        </div>
    </nav>
</header>