<form method="post" action="{{ route('user.store') }}" class="flex flex-col">
    @csrf

    <div class="mb-4 flex flex-col">
        <label for="name" class="font-semibold mb-1">Name</label>
        <input type="text" id="name" name="name" class="rounded-md border border-gray-300 text-gray-800 p-2">
        @error('name')
        <span class="text-red-400 tex-sm">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4 flex flex-col">
        <label for="email" class="font-semibold mb-1">Email</label>
        <input type="text" id="email" name="email" class="rounded-md border border-gray-300 text-gray-800 p-2">
        @error('email')
        <span class="text-red-400 tex-sm">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4 flex flex-col">
        <label for="password" class="font-semibold mb-1">Password</label>
        <input type="text" id="password" name="password" class="rounded-md border border-gray-300 text-gray-800 p-2">
        @error('password')
        <span class="text-red-400 tex-sm">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex justify-end">
        <button type="submit" class="p-3 w-1/2 bg-blue-500 text-blue-100 rounded-md shadow-md hover:bg-blue-600 transition-all ease-in-out duration-150">Submit</button>
    </div>
</form>
