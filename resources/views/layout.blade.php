<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.21.0/themes/prism-coy.min.css" integrity="sha512-CKzEMG9cS0+lcH4wtn/UnxnmxkaTFrviChikDEk1MAWICCSN59sDWIF0Q5oDgdG9lxVrvbENSV1FtjLiBnMx7Q==" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <style>
        [x-cloak] {
            display: none;
        }
    </style>
    <title>Document</title>
</head>
<body>

<div class="container mx-auto border-md h-screen p-8 flex flex-col" x-data="{active: 'view'}">
    <div class="flex mb-4">
        <label x-on:click="active = 'view'" x-bind:class="{'bg-blue-300 text-blue-900': (active === 'view')}" class="cursor-pointer bg-gray-200 text-gray-800 px-4 py-2 rounded-md">View</label>
        <label x-on:click="active = 'blade'" x-bind:class="{'bg-blue-300 text-blue-900': (active === 'blade')}" class="cursor-pointer bg-gray-200 text-gray-800 px-4 py-2 rounded-md ml-4">Blade</label>
        <label x-on:click="active = 'html'" x-bind:class="{'bg-blue-300 text-blue-900': (active === 'html')}" class="cursor-pointer bg-gray-200 text-gray-800 px-4 py-2 rounded-md ml-4">Html</label>
    </div>
    <div class="flex-1 w-full" x-cloak x-show="active === 'view'">
        <div class="p-8 border border-gray-300 rounded-lg shadow-2xl">
            @yield('content')
        </div>
    </div>
    @hasSection('code')
    <div class="w-full h-full" x-cloak x-show="active === 'blade'">
        @yield('code')
    </div>
    @endif
    @hasSection('html')
    <div class="w-full h-full" x-cloak x-show="active === 'html'">
        @yield('html')
    </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/prismjs@1.21.0/prism.min.js"></script>
</body>
</html>
