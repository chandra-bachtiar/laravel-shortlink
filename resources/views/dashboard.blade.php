<x-app-layout>
    <div class="px-10">
        <h1 class="text-4xl font-bold dark:text-white text-gray-700">{{ $greeting . ', ' . Auth::user()->name }}</h1>
        <h1 class="dark:text-white text-gray-700">{{ $dayName }}, <span id="text-clock"></span></h1>
        <h1 class="mt-4 dark:text-white text-gray-700"></h1>

        <div>
            <div id="stats" class="grid gird-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="dark:bg-black/60 bg-white  to-white/5 p-6 rounded-lg">
                    <div class="flex flex-row space-x-4 items-center">
                        <div id="stats-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-10 h-10 dark:text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                            </svg>

                        </div>
                        <div>
                            <p class="text-indigo-500 dark:text-indigo-300 text-sm font-medium uppercase leading-4">Shortlink Created</p>
                            <p class="text-gray-700 dark:text-white font-bold text-2xl inline-flex items-center space-x-2">
                                <span>{{ $totalCreated }} Shortlink</span>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                    </svg>

                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-black/60 p-6 rounded-lg">
                    <div class="flex flex-row space-x-4 items-center">
                        <div id="stats-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-10 h-10 dark:text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zM12 2.25V4.5m5.834.166l-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243l-1.59-1.59" />
                            </svg>


                        </div>
                        <div>
                            <p class="dark:text-teal-300 text-teal-500 text-sm font-medium uppercase leading-4">Total Clicks</p>
                            <p class="text-gray-700 font-bold text-2xl inline-flex items-center space-x-2 dark:text-white">
                                <span>{{$totalClicks}} Click</span>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                    </svg>

                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-black/60 p-6 rounded-lg">
                    <div class="flex flex-row space-x-4 items-center">
                        <div id="stats-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-10 h-10 dark:text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                            </svg>


                        </div>
                        <div>
                            <p class="text-blue-500 dark:text-blue-300 text-sm font-medium uppercase leading-4">Expired</p>
                            <p class="dark:text-white text-gray-700 font-bold text-2xl inline-flex items-center space-x-2">
                                <span>{{$totalExpired}} Link</span>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                    </svg>

                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Short Link
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Full Link
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Clicks
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Expired
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shortlinks as $link)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <span class="hover:text-blue-500 hover:cursor-pointer"
                                    onclick="toUrl('{{ url('/' . $link->shorturl) }}')">
                                    /{{ $link->shorturl }}
                                </span>
                            </th>
                            <td class="px-6 py-4">
                                <span class="hover:text-blue-500 hover:cursor-pointer"
                                    onclick="toUrl('{{ $link->longurl }}')">
                                    {{-- limit just show 100character --}}
                                    {{ Str::limit($link->longurl, 80) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $link->clicks }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $link->expired }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="#"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                <a href="#"
                                    class="font-medium text-red-600 dark:text-red-600 hover:underline ml-4">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $shortlinks->links() }}


    </div>
    <script>
        (function() {
            const clock = document.querySelector('#text-clock');
            setInterval(() => {
                clock.textContent = new Date().toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
            }, 1000);
        })();

        function toUrl(url) {
            window.location.href = url;
        }
    </script>
</x-app-layout>
