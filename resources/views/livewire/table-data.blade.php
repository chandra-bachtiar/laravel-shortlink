<div>
    <div class="relative mt-8 overflow-x-auto shadow-md sm:rounded-lg">
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
                            <button 
                                wire:click="modalEdit({{ $link }})"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline hover:cursor-pointer">
                                Edit</button>
                            <button  wire:click="modalDelete({{ $link->id }})"
                                class="ml-4 font-medium text-red-600 dark:text-red-600 hover:underline hover:cursor-pointer">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($edited)
            <div class="relative flex justify-center">
                <div x-transition:enter="transition duration-300 ease-out"
                    x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
                    x-transition:leave="transition duration-150 ease-in"
                    x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
                    x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                    class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
                    aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen text-center sm:block sm:p- bg-gray-700/50">
                        <span class="hidden sm:inline-block sm:h-screen sm:align-middle"
                            aria-hidden="true">&#8203;</span>
                        <div
                            class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-900 sm:my-8 sm:w-full sm:max-w-4xl sm:p-6 sm:align-middle">
                            <h3 class="text-lg font-medium leading-6 text-gray-800 dark:text-white" id="modal-title">
                                {{ '/' . $shorturl }}
                            </h3>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                {{ __('This link has clicked ') . $clicks . __(' times') }}
                            </p>

                            <form class="mt-4" method="POST" action="{{ route('link.edit') }}" id="form-edit">
                                @csrf
                                <input type="hidden" value="{{ $idurl }}" name="id">
                                <label for="shorturl-list" class="text-sm text-gray-700 dark:text-gray-200">
                                    Short Link
                                </label>
                                <label class="block pb-3 mt-3" for="shorturl">
                                    <input type="text" name="shorturl" id="shorturl" placeholder="/short-url"
                                        value="{{ $shorturl }}"
                                        class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300" />
                                </label>

                                <label for="longurl-list" class="text-sm text-gray-700 dark:text-gray-200">
                                    Long Link
                                </label>

                                <label class="block pb-3 mt-3" for="longurl">
                                    <input type="text" name="longurl" id="longurl" placeholder="/long-url"
                                        value="{{ $longurl }}"
                                        class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300" />
                                </label>

                                <div x-data="{ checked: false }" class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div>
                                        <label for="expired-list" class="text-sm text-gray-700 dark:text-gray-200">
                                            Expired
                                        </label>
                                        <label class="block pb-3 mt-3" for="expired">
                                            <input type="date" name="expired" id="expired" placeholder="/short-url"
                                                value="{{ $expired }}"
                                                class="block w-full px-4 py-3 text-sm text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300" />
                                        </label>
                                    </div>
                                    <div>
                                        <label for="active" class="inline-flex items-center md:pt-10">
                                            <input id="active" type="checkbox"
                                                class="text-indigo-600 border-gray-300 rounded shadow-sm dark:bg-gray-900 dark:border-gray-700 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                                name="active" {{ $active ? 'checked' : '' }}>
                                            <span
                                                class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Active ?') }}</span>
                                        </label>
                                    </div>

                                </div>

                                <div class="mt-4 sm:flex sm:items-center sm:-mx-2">
                                    <button type="button" wire:click="$set('edited',false)"
                                        class="w-full px-4 py-2 text-sm font-medium tracking-wide text-gray-700 capitalize transition-colors duration-300 transform border border-gray-200 rounded-md sm:w-1/2 sm:mx-2 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40">
                                        Cancel
                                    </button>

                                    <button type="submit"
                                        class="w-full px-4 py-2 mt-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($deleted)
            <div class="relative flex justify-center">
                <div x-transition:enter="transition duration-300 ease-out"
                    x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
                    x-transition:leave="transition duration-150 ease-in"
                    x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
                    x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                    class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title-delete" role="dialog"
                    aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen text-center sm:block sm:p- bg-gray-700/50">
                        <span class="hidden sm:inline-block sm:h-screen sm:align-middle"
                            aria-hidden="true">&#8203;</span>
                        <div
                            class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-900 sm:my-8 sm:w-full sm:max-w-xl sm:p-6 sm:align-middle">
                            <h3 class="text-lg font-medium leading-6 text-gray-800 dark:text-white"
                                id="modal-title-delete">
                                {{ __('Delete Link') }}
                            </h3>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                {{ __('This link has clicked ') . $clicks . __(' times') }}
                            </p>

                            <form class="mt-4" method="POST" action="{{ route('link.delete') }}"
                                id="form-delete">
                                @csrf
                                <input type="hidden" value="{{ $idurl }}" name="id-delete">

                                <h1 class="text-4xl font-bold text-white dark:text-gray-700">
                                    {{ __('Are you sure you want to delete this link ?') }}
                                </h1>

                                <div class="mt-4 sm:flex sm:items-center sm:-mx-2">
                                    <button type="button" wire:click="$set('deleted',false)"
                                        class="w-full px-4 py-2 text-sm font-medium tracking-wide text-gray-700 capitalize transition-colors duration-300 transform border border-gray-200 rounded-md sm:w-1/2 sm:mx-2 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40">
                                        Cancel
                                    </button>

                                    <button type="submit"
                                        class="w-full px-4 py-2 mt-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-red-600 rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-red-500 focus:outline-none focus:ring focus:ring-red-300 focus:ring-opacity-40">
                                        Delete
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    {{ $shortlinks->links() }}

</div>
