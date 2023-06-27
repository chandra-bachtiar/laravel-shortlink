<x-app-layout>
    <div class="max-w-7xl w-full h-full mx-auto p-6 lg:p-8 flex">
        <div>
            <div class="mt-4">
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8 w-full">

                    {{-- create a input using tailwind and darkmode --}}
                    <form method="POST" action="{{ route('link.edit') }}">
                        <div class="w-full px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden rounded-lg">
                            <h1 class="text-2xl dark:text-white font-bold">Edit Data</h1>
                            @csrf
                            <input type="hidden" name="id" value="{{ $link->id }}">
                            <div>
                                <x-input-label for="name" :value="__('Long Url')" />
                                <x-text-input id="longurl" class="block mt-1 w-full" type="text" name="longurl"
                                    :value="old('longurl')" value="{{ $link->longurl }}" required autofocus
                                    autocomplete="longurl" placeholder="Paste Your Long Url" />
                                <x-input-error :messages="$errors->get('long-url')" class="mt-2" />
                            </div>
                            <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <x-input-label for="name" :value="__('Custom Link')" />
                                    <x-text-input id="shorturl" class="block mt-1 w-full" type="text"
                                        name="shorturl" :value="old('shorturl')" value="{{ $link->shorturl }}" required
                                        autofocus autocomplete="shorturl"
                                        placeholder="{{ 'ex. type custom-url will be ' . $url . '/custom-url' }}" />
                                    <x-input-error :messages="$errors->get('long-url')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="name" :value="__('Expired')" />
                                    <x-text-input id="expired" class="block mt-1 w-full" type="date" name="expired"
                                        :value="old('expired')" value="{{ $link->expired }}" required autofocus
                                        autocomplete="expired" />
                                    <x-input-error :messages="$errors->get('long-url')" class="mt-2" />
                                    <p class="text-white text-sm pt-2 ps-2">Default expired for registered user is 7
                                        days</p>
                                </div>
                                <div class="flex justify-center">
                                    <label for="active" class="inline-flex items-center md:pt-10">
                                        <input id="active" type="checkbox"
                                            class="text-indigo-600 border-gray-300 rounded shadow-sm dark:bg-gray-900 dark:border-gray-700 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                            name="active" {{ $link->active ? 'checked' : '' }}>
                                        <span
                                            class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Active ?') }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="flex justify-center pt-4">
                                <x-primary-button class="ml-3">
                                    {{ __('Update Shortlink') }}
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                    </svg>
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
