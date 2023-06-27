<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        .toast {
            opacity: 1 !important;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-[#321E1E]">
        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow dark:bg-gray-800">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif


        <!-- component -->
        <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');" @resize.window="watchScreen()">
            <div class="flex h-screen antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">
                <!-- Loading screen -->
                <div x-ref="loading"
                    class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-indigo-800">
                    Loading.....
                </div>

                <!-- Sidebar -->
                <div class="flex flex-shrink-0 transition-all bg-white dark:bg-[#116D6E]">
                    <div x-show="isSidebarOpen" @click="isSidebarOpen = false"
                        class="fixed inset-0 z-10 bg-black bg-opacity-50 lg:hidden"></div>
                    <div x-show="isSidebarOpen" class="fixed inset-y-0 z-10 w-16 bg-white dark:bg-[#321E1E]"></div>

                    <!-- Mobile bottom bar -->
                    <nav aria-label="Options"
                        class=" z-[999] fixed inset-x-0 bottom-0 flex flex-row-reverse items-center justify-between px-4 py-2 bg-white border-t border-indigo-100 dark:bg-gray-800 sm:hidden shadow-t rounded-t-3xl">
                        <!-- Menu button -->
                        <a @click="(isSidebarOpen && currentSidebarTab == 'linksTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'linksTab'"
                            class="dark:text-white pr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </a>
                        {{-- <button
                            @click="(isSidebarOpen && currentSidebarTab == 'linksTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'linksTab'"
                            class=" p-2 transition-colors rounded-lg shadow-md hover:bg-indigo-800 hover:text-white focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2"
                            :class="(isSidebarOpen && currentSidebarTab == 'linksTab') ? 'text-white bg-indigo-600' :
                            'text-gray-500 bg-white'">
                            <span class="sr-only">Toggle sidebar</span>
                            <svg aria-hidden="true" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </button> --}}

                        <!-- Logo -->
                        <a href="/create" class="dark:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </a>

                        <!-- User avatar button -->
                        <div class="relative flex items-center flex-shrink-0 p-2" x-data="{ isOpen: false }">
                            <button @click="isOpen = !isOpen; $nextTick(() => {isOpen ? $refs.userMenu.focus() : null})"
                                class="text-white transition-opacity rounded-lg opacity-80 hover:opacity-100 focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>

                                <span class="sr-only">User menu</span>
                            </button>
                            <div x-show="isOpen" @click.away="isOpen = false" @keydown.escape="isOpen = false"
                                x-ref="userMenu" tabindex="-1"
                                class="absolute w-48 py-1 mt-2 origin-bottom-left bg-white rounded-md shadow-lg left-10 bottom-14 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-label="user menu">
                                <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">Your Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"role="menuitem"
                                        onclick="event.preventDefault();
                                        this.closest('form').submit();">Sign
                                        out</a>
                                </form>
                            </div>
                        </div>
                    </nav>

                    <!-- Left mini bar -->
                    <nav aria-label="Options"
                        class="z-20 flex-col items-center flex-shrink-0 hidden w-16 py-4 bg-white dark:bg-[#321E1E] border-indigo-100 shadow-md sm:flex rounded-tr-3xl rounded-br-3xl ">
                        <!-- Logo -->
                        <div class="flex-shrink-0 py-4">
                            {{-- <a href="#">
                                <img class="w-10 h-auto"
                                    src="https://raw.githubusercontent.com/kamona-ui/dashboard-alpine/main/public/assets/images/logo.png"
                                    alt="K-UI" />
                            </a> --}}
                        </div>
                        <div class="flex flex-col items-center flex-1 p-2 space-y-4">
                            <!-- Menu button -->
                            <button onclick="window.location.href='{{ route('url.create') }}'"
                                class="p-2 transition-colors rounded-lg shadow-md hover:bg-[#CD1818] bg-indigo-800 text-white focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2">
                                <span class="sr-only">Toggle sidebar</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 h-6">
                                    <path fill-rule="evenodd"
                                        d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z"
                                        clip-rule="evenodd" />
                                </svg>

                            </button>
                            <!-- Messages button -->
                            <button
                                @click="(isSidebarOpen && currentSidebarTab == 'linksTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'linksTab'"
                                class="p-2 transition-colors rounded-lg shadow-md hover:bg-indigo-800 hover:text-white focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2"
                                :class="(isSidebarOpen && currentSidebarTab == 'linksTab') ? 'text-white bg-indigo-600' :
                                'text-gray-500 bg-white'">
                                <span class="sr-only">Toggle sidebar</span>
                                <svg aria-hidden="true" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h7" />
                                </svg>
                            </button>
                            <!-- Messages button -->
                            <button
                                @click="(isSidebarOpen && currentSidebarTab == 'messagesTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'messagesTab'"
                                class="p-2 transition-colors rounded-lg shadow-md hover:bg-indigo-800 hover:text-white focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2"
                                :class="(isSidebarOpen && currentSidebarTab == 'messagesTab') ? 'text-white bg-indigo-600' :
                                'text-gray-500 bg-white'">
                                <span class="sr-only">Toggle message panel</span>
                                <svg aria-hidden="true" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                            </button>
                            <!-- Notifications button -->
                            <button
                                @click="(isSidebarOpen && currentSidebarTab == 'notificationsTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'notificationsTab'"
                                class="p-2 transition-colors rounded-lg shadow-md hover:bg-indigo-800 hover:text-white focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2"
                                :class="(isSidebarOpen && currentSidebarTab == 'notificationsTab') ?
                                'text-white bg-indigo-600' :
                                'text-gray-500 bg-white'">
                                <span class="sr-only">Toggle notifications panel</span>
                                <svg aria-hidden="true" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </button>
                        </div>

                        <!-- User avatar -->
                        <div class="relative flex items-center flex-shrink-0 p-2" x-data="{ isOpen: false }">
                            <button
                                @click="isOpen = !isOpen; $nextTick(() => {isOpen ? $refs.userMenu.focus() : null})"
                                class="transition-opacity rounded-lg opacity-80 hover:opacity-100 focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6 dark:text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>

                                <span class="sr-only">User menu</span>
                            </button>
                            <div x-show="isOpen" @click.away="isOpen = false" @keydown.escape="isOpen = false"
                                x-ref="userMenu" tabindex="-1"
                                class="absolute w-48 py-1 mt-2 origin-bottom-left bg-white rounded-md shadow-lg left-10 bottom-14 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-label="user menu">
                                <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">Your Profile</a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:cursor-pointer"
                                        role="menuitem"
                                        onclick="event.preventDefault();
                                        this.closest('form').submit();">Sign
                                        out</a>
                                </form>
                            </div>
                        </div>
                    </nav>

                    <div x-transition:enter="transform transition-transform duration-300"
                        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                        x-transition:leave="transform transition-transform duration-300"
                        x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                        x-show="isSidebarOpen"
                        class="fixed inset-y-0 left-0 z-10 flex-shrink-0 w-64 bg-white dark:bg-[#321E1E] border-r-2 border-indigo-100 shadow-lg sm:left-16 rounded-tr-3xl rounded-br-3xl sm:w-72 lg:static lg:w-64">
                        <nav x-show="currentSidebarTab == 'linksTab'" aria-label="Main" class="flex flex-col h-full">
                            <!-- Logo -->
                            <div class="flex items-center justify-center flex-shrink-0 py-10">
                                {{-- <a href="#">
                                    <img class="w-24 h-auto"
                                        src="https://raw.githubusercontent.com/kamona-ui/dashboard-alpine/main/public/assets/images/logo.png"
                                        alt="K-UI" />
                                </a> --}}
                            </div>

                            <!-- Links -->
                            <div class="flex-1 px-4 space-y-2 overflow-hidden hover:overflow-auto">
                                <a href="/dashboard"
                                    class="flex items-center w-full space-x-2 text-white bg-indigo-600 rounded-lg">
                                    <span aria-hidden="true" class="p-2 bg-indigo-700 rounded-lg">
                                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                    </span>
                                    <span>Dashboard</span>
                                </a>
                            </div>
                        </nav>

                        <section x-show="currentSidebarTab == 'messagesTab'" class="px-4 py-6">
                            <h2 class="text-xl dark:text-indigo-700">Messages</h2>
                        </section>

                        <section x-show="currentSidebarTab == 'notificationsTab'" class="px-4 py-6">
                            <h2 class="text-xl dark:text-indigo-700">Notifications</h2>
                        </section>
                    </div>
                </div>
                <div class="flex flex-col flex-1">
                    <div class="flex flex-1 dark:bg-[#116D6E] bg-white">
                        {{-- content here --}}
                        <main class="w-full pt-4">
                            {{ $slot }}
                        </main>

                    </div>
                </div>
            </div>

            <!-- Panels -->

            <!-- Settings Panel -->
            <!-- Backdrop -->
            <div x-show="isSettingsPanelOpen" class="fixed inset-0 bg-black bg-opacity-50"
                @click="isSettingsPanelOpen = false" aria-hidden="true"></div>
            <!-- Panel -->
            <section x-transition:enter="transform transition-transform duration-300"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transform transition-transform duration-300"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                x-show="isSettingsPanelOpen"
                class="fixed inset-y-0 right-0 w-64 bg-white border-l border-indigo-100 rounded-l-3xl">
                <div class="px-4 py-8">
                    <h2 class="text-lg font-semibold">Settings</h2>
                </div>
            </section>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
    <script>
        const setup = () => {
            return {
                isSidebarOpen: false,
                currentSidebarTab: null,
                isSettingsPanelOpen: false,
                isSubHeaderOpen: false,
                watchScreen() {
                    if (window.innerWidth <= 1024) {
                        this.isSidebarOpen = false
                    }
                },
            }
        }
    </script>


    </div>
    @livewireScripts
    @include('sweetalert::alert')
</body>

</html>
