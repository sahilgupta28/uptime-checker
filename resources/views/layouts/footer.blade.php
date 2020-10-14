<footer class='w-full bg-blue-900 justify-between text-center bg-blue-900 p-6 mt-8'>
    <div class="flex items-center flex-shrink-0 text-white mr-6 justify-center">
        <span class="font-semibold text-sm tracking-tight text-blue-300">
            <small>Build with <i class="fas fa-heart text-red-700"></i> & lots of &#127861; by</small>
            <a href="{{ config('constants.FOUNDER.WEBSITE') }}" target="_blank">{{ config('constants.FOUNDER.NAME') }}</a>
        </span>
    </div>
    <div class="w-full flex flex-wrap -mx-3 text-left">
    <div class="font-semibold text-sm tracking-tight text-blue-300 w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <a class="px-1" href="{{ route('home') }}">Home</a> | 
        <a class="px-1" href="{{ route('privacy.policy') }}" target="_blank">Privacy Policy</a>
    </div>
    <div class="font-semibold text-sm tracking-tight text-blue-300 w-full md:w-1/2 px-3 mb-6 md:mb-0 text-right">
        <a class="px-1" href="{{ config('constants.FOUNDER.TWITTER') }}" target="_blank"><i class="fa fa-twitter"></i></a>
        <a class="px-1" href="{{ config('constants.FOUNDER.LINKED_IN') }}" target="_blank"><i class="fa fa-linkedin"></i></a>
        <a class="px-1" href="{{ config('constants.FOUNDER.GITHUB') }}" target="_blank"><i class="fa fa-github-alt"></i></a>
        <a class="px-1" href="{{ config('constants.FOUNDER.STACK_OVERFLOW') }}" target="_blank"><i class="fa fa-stack-overflow"></i></a>
        <a class="px-1" href="{{ config('constants.FOUNDER.BLOG') }}" target="_blank"><i class="fab fa-blogger-b"></i></a>
    </div>
    </div>
</footer>