<form method="get"
    class="flex flex-col">

    @csrf

    <label for="name" class="font-semibold mb-1">Name</label>
    <input type="text" id="name" name="name" class="rounded-md border border-gray-300 text-gray-800 p-2 mb-4">

    <label for="email" class="font-semibold mb-1">Email</label>
    <input type="text" id="email" name="email" class="rounded-md border border-gray-300 text-gray-800 p-2 mb-4">

    <label for="password" class="font-semibold mb-1">Password</label>
    <input type="text" id="password" name="password" class="rounded-md border border-gray-300 text-gray-800 p-2 mb-4">

    <div class="flex justify-end">
        <button type="submit" class="p-3 w-1/2 bg-blue-500 text-blue-100 rounded-md shadow-md hover:bg-blue-600 transition-all ease-in-out duration-150">Submit</button>
    </div>
</form>
