<div class="container mx-auto">
    <div class="flex justify-end">
        <form method="GET" class="flex py-4">
            <input type="text" name="search" placeholder="Search..." value="{{ request()->get('search') }}" aria-label="Search" class="px-4 bg-gray-100 text-gray-700 rounded-md focus:bg-white border border-gray-300 mr-4">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-blue-100 rounded-md hover:bg-blue-600">Search</button>
        </form>
    </div>
    <table class="w-full rounded-lg border-gray-300 border">
        <thead class="bg-gray-100">
        <tr>
            <th class="py-1 px-4 text-gray-800 text-left">Name</th>
            <th class="py-1 px-4 text-gray-800 text-left">Email</th>
            <th class="py-1 px-4 text-gray-800 text-left">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="{{ $loop->iteration % 2 === 0 ? 'bg-gray-100' : 'bg-white' }}">
                <td class="py-1 px-4 text-gray-800">{{ $user->name }}</td>
                <td class="py-1 px-4 text-gray-800">{{ $user->email }}</td>
                <td class="py-1 px-4 text-gray-800">
                    <form action="{{route('user.delete', ['user' => $user->id])}}" method="POST">
                        @method('delete')
                        @csrf
                        <button type="submit" class="px-2 py-1 text-sm text-red-100 bg-red-500 hover:bg-red-600 rounded-md">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="flex mt-4 flex justify-end">
        @if ($users->currentPage() > 1)
            <a href="{{ $users->path() }}?page={{$users->currentPage() - 1}}" class="px-4 mr-4 py-2 border border-gray-500 bg-white text-gray-800 rounded-md hover:bg-gray-100">Prev</a>
        @endif
        @if ($users->hasMorePages())
            <a href="{{ $users->path() }}?page={{$users->currentPage() + 1}}" class="px-4 py-2 border border-gray-500 bg-white text-gray-800 rounded-md hover:bg-gray-100">Next</a>
        @endif
    </div>
</div>
