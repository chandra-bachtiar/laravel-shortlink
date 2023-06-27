<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="max-w-7xl w-full mx-auto p-6 lg:p-8">
            <div class="w-full text-center">
                <h1 class="dark:text-white text-4xl font-bold">Meet Our Teams</h1>
                <p class="dark:text-white">Our Greates Team Ever!</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 pt-14">
                <div class="w-full">
                    <div class="w-full flex justify-center">
                        <img src="{{ asset('img/chandra.jpg') }}" alt="chandra" class="w-full h-auto rounded-full overflow-hidden">
                    </div>
                    <div class="w-full text-center">
                        <h1 class="dark:text-white text-2xl font-bold">Chandra Bachtiar</h1>
                        <p class="dark:text-white text-sm">200511151</p>
                    </div>
                </div>
                <div class="w-full">
                    <div class="w-full">
                        <img src="{{ asset('img/marisa.jpg') }}" alt="chandra" class="w-full h-auto rounded-full overflow-hidden">
                    </div>
                    <div class="w-full text-center">
                        <h1 class="dark:text-white text-2xl font-bold">Marisa Naofa</h1>
                        <p class="dark:text-white text-sm">200511074</p>
                    </div>
                </div>
                <div class="w-full">
                    <div class="w-full">
                        <img src="{{ asset('img/rinaldi.jpg') }}" alt="chandra" class="w-full h-auto rounded-full overflow-hidden">
                    </div>
                    <div class="w-full text-center">
                        <h1 class="dark:text-white text-2xl font-bold">Mohammad Rinaldi</h1>
                        <p class="dark:text-white text-sm">200511141</p>
                    </div>
                </div>
                <div class="w-full">
                    <div class="w-full">
                        <img src="https://i.pravatar.cc/500?u=riski-pratam" alt="chandra" class="w-full h-auto rounded-full overflow-hidden">
                    </div>
                    <div class="w-full text-center">
                        <h1 class="dark:text-white text-2xl font-bold">Riski Pratama</h1>
                        <p class="dark:text-white text-sm">200511083</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</body>

</html>
