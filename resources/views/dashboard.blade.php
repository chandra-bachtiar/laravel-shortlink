<x-app-layout>
    <div class="px-10">
        <h1 class="text-4xl font-bold text-gray-700 dark:text-white">{{ $greeting . ', ' . Auth::user()->name }}</h1>
        <h1 class="text-gray-700 dark:text-white">{{ $dayName }}, <span id="text-clock"></span></h1>
        <h1 class="mt-4 text-gray-700 dark:text-white"></h1>

        <div>
            <div id="stats" class="grid gap-6 gird-cols-1 md:grid-cols-2 lg:grid-cols-3">
                <div class="p-6 bg-white rounded-lg dark:bg-black/60 to-white/5">
                    <div class="flex flex-row items-center space-x-4">
                        <div id="stats-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-10 h-10 dark:text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                            </svg>

                        </div>
                        <div>
                            <p class="text-sm font-medium leading-4 text-indigo-500 uppercase dark:text-indigo-300">
                                Shortlink Created</p>
                            <p
                                class="inline-flex items-center space-x-2 text-2xl font-bold text-gray-700 dark:text-white">
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
                <div class="p-6 bg-white rounded-lg dark:bg-black/60">
                    <div class="flex flex-row items-center space-x-4">
                        <div id="stats-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-10 h-10 dark:text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zM12 2.25V4.5m5.834.166l-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243l-1.59-1.59" />
                            </svg>


                        </div>
                        <div>
                            <p class="text-sm font-medium leading-4 text-teal-500 uppercase dark:text-teal-300">Total
                                Clicks</p>
                            <p
                                class="inline-flex items-center space-x-2 text-2xl font-bold text-gray-700 dark:text-white">
                                <span>{{ $totalClicks }} Click</span>
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
                <div class="p-6 bg-white rounded-lg dark:bg-black/60">
                    <div class="flex flex-row items-center space-x-4">
                        <div id="stats-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-10 h-10 dark:text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium leading-4 text-blue-500 uppercase dark:text-blue-300">Expired
                            </p>
                            <p
                                class="inline-flex items-center space-x-2 text-2xl font-bold text-gray-700 dark:text-white">
                                <span>{{ $totalExpired }} Link</span>
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
        @if ($isDesktop)
            @livewire('table-data')
        @else
            @livewire('table-data-mobile')
        @endif


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
