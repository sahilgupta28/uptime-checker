<div class="w-full mt-4 bg-blue-900 px-6 py-3">
    <div class="flex justify-between">
        <h3 class="text-white text-3xl flex-6">All Websites</h3>
        @can('admin', auth()->user())
        <a type="button" class="shadow bg-purple-500 flex-6 mb-4 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white p-2 rounded" href="{{ route('admin.dashboard') }}">
            <i class="fa fa-chevron-left"></i> BACK
        </a>
        @endcan
    </div>
    <table class="table-fixed w-full text-blue-800 border-gray-500">
        <thead>
            <tr class="text-gray-500">
                <th class="w-1/12 px-4 py-2">#</th>
                <th class="w-2/12 px-4 py-2">Title</th>
                <th class="w-3/12 px-4 py-2">Domain</th>
                <th class="w-3/12 px-4 py-2">UP Time Status</th>
                <th class="w-2/12 px-4 py-2">Last Tested</th>
                <th class="w-2/12 px-4 py-2">Status</th>
                <th class="w-1/12 px-4 py-2">ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach($websites as $website)
            <tr>
                <th class="border-gray-500 bg-gray-300 border px-4 py-2">{{$loop->iteration}}</th>
                <td class="border-gray-500 bg-gray-300 border px-4 py-2">
                    <a href="{{ route('website.show',$website->id) }}">{{$website->title}}</a></td>
                <td class="border-gray-500 bg-gray-300 border px-4 py-2">{{$website->domain}}</td>
                <td class="border-gray-500 bg-gray-300 border px-4 py-2"> 
                    @foreach($website->testLogsLimit->reverse() as $test_log)
                        <i class="fa @if($test_log->status) fa-check-circle text-green-600 @else fa-times-circle text-gray-500 @endif" data-toggle="tooltip" data-placement="top" title="{{\Carbon\Carbon::parse($test_log->test_at)->diffForHumans()}}"></i>
                    @endforeach
                </td>
                <td class="border-gray-500 bg-gray-300 border px-4 py-2">{{\Carbon\Carbon::parse($website->test_at)->diffForHumans()}}</td>
                <td class="border-gray-500 bg-gray-300 border px-4 py-2">
                    <form action="{{route('website.status', $website->id)}}" method="POST" class="md:w-1/2 mb-6">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="is_active" value="{{ (int)!$website->is_active }}">
                        <button type="submit" class="fa fa-toggle-on  text-green-500 fa-3x text-lg" @if(!$website->is_active) style="display:none" @endif></button>
                        <button type="submit" class="fa fa-toggle-off text-red-500 fa-3x text-lg" @if($website->is_active) style="display:none" @endif></button>
                    </form>
                </td>
                <td class="border-gray-500 bg-gray-300 border px-1 py-2 w-full">
                    @can('active',$website)
                    <form action="{{route('website.test', $website->id)}}" method="POST" class="md:w-1/2 mb-6">
                    @csrf
                        <button type="submit" class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white py-2 px-1 rounded text-sm ">Test</button>
                    </form>
                    @endcan
                    @can('user', auth()->user())
                    <a type="button" class="shadow bg-purple-500 md:w-1/2 mb-4 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white py-2 px-1 rounded text-sm " href="{{ route('website.show',$website->id) }}">Edit</a>
                    <form action="{{route('website.delete', $website->id)}}" method="POST" class="md:w-1/2 mb-6">
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="shadow bg-red-500 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white py-2 px-1 rounded text-sm ">Delete</button>
                    </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $websites->links('pagination/default') }}
</div>