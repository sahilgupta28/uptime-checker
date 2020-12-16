<div class="w-full mt-4 bg-blue-900 px-6 py-3">
    <h3 class="text-white text-3xl">All Users</h3>
    <table class="table-fixed w-full text-blue-800 border-gray-500">
        <thead>
            <tr class="text-gray-500">
                <th class="w-1/12 px-4 py-2">#</th>
                <th class="w-2/12 px-4 py-2">Name</th>
                <th class="w-3/12 px-4 py-2">Email</th>
                <th class="w-1/12 px-4 py-2">ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <th class="border-gray-500 bg-gray-300 border px-4 py-2">{{$loop->iteration}}</th>
                <td class="border-gray-500 bg-gray-300 border px-4 py-2">
                    <a href="{{-- route('website.show',$website->id) --}}">{{$user->name}}</a></td>
                <td class="border-gray-500 bg-gray-300 border px-4 py-2">{{$user->email ?? 'Social Login'}}</td>
               
                <td class="border-gray-500 bg-gray-300 border px-1 py-2 w-full">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links('pagination/default') }}
</div>