<div class="border-1 dark:border-white border-black pt-5 pb-20">
    <hr>
    @foreach ($shortlinks as $link)
        <div class="p-6 mt-5 bg-white rounded-lg dark:bg-black/60 to-white/5">
            <div class="flex flex-row items-center space-x-4">
                <div>
                    <div class="grid grid-cols-2">
                        <div class="align-middle">
                            <p class="text-sm font-medium leading-4 text-indigo-500 uppercase dark:text-indigo-300">
                                {{ $link->expired }}
                            </p>
                        </div>
                    </div>
                    <p class="inline-flex items-center space-x-2 text-xl font-bold text-gray-700 dark:text-white">
                        <span>{{ Str::limit('/' . $link->shorturl, 20, '...') }}</span>
                    </p>
                    <p class="inline-flex items-center space-x-2 text-sm font-bold text-gray-700 dark:text-white">
                        <span>{{ Str::limit($link->longurl, 30, '...') }}</span>
                    </p>
                    <div class="py-2 w-fit grid grid-cols-2 gap-2">
                        <div class="border-2 dark:border-indigo-300 border-solid rounded-md px-2 dark:text-indigo-300">
                            {{ $link->clicks }} Clicks
                        </div>
                        @if ($link->active)
                            <div
                                class="border-2 dark:border-indigo-300 border-solid rounded-md px-2 dark:text-indigo-300 flex pt-[2px]">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-4 h-4 text-right">
                                    <path fill-rule="evenodd"
                                        d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="text-sm">Active</p>
                            </div>
                        @else
                            <div
                                class="border-2 dark:border-red-400 border-solid rounded-md px-2 dark:text-red-400 flex pt-[2px]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-right">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                  </svg>
                                  
                                <p class="text-sm">Inactive</p>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
            <div id="button-action">
                {{-- add button copy, edit, and delete using tailwind --}}
                <div class="flex justify-between space-x-2">
                    <div class="border-2 dark:text-white text-gray-600 border-solid rounded-md px-2 flex pt-[2px]"
                        onclick="copyShortlink('{{ url('/' . $link->shorturl) }}')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd"
                                d="M17.663 3.118c.225.015.45.032.673.05C19.876 3.298 21 4.604 21 6.109v9.642a3 3 0 01-3 3V16.5c0-5.922-4.576-10.775-10.384-11.217.324-1.132 1.3-2.01 2.548-2.114.224-.019.448-.036.673-.051A3 3 0 0113.5 1.5H15a3 3 0 012.663 1.618zM12 4.5A1.5 1.5 0 0113.5 3H15a1.5 1.5 0 011.5 1.5H12z"
                                clip-rule="evenodd" />
                            <path
                                d="M3 8.625c0-1.036.84-1.875 1.875-1.875h.375A3.75 3.75 0 019 10.5v1.875c0 1.036.84 1.875 1.875 1.875h1.875A3.75 3.75 0 0116.5 18v2.625c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625v-12z" />
                            <path
                                d="M10.5 10.5a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963 5.23 5.23 0 00-3.434-1.279h-1.875a.375.375 0 01-.375-.375V10.5z" />
                        </svg>

                        <p class="text-sm">Copy</p>
                    </div>
                    <div class="border-2 border-indigo-300 border-solid rounded-md px-2 text-indigo-300 flex pt-[2px]"
                        onclick="toEdit({{ $link->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                            <path
                                d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                        </svg>

                        <p class="text-sm">Edit</p>
                    </div>
                    <div class="border-2 border-red-500 border-solid rounded-md px-2 text-red-300 flex pt-[2px]"
                        onclick="deleteConfirm({{ $link->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd"
                                d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                                clip-rule="evenodd" />
                        </svg>

                        <p class="text-sm">Delete</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- pagination --}}
    {{ $shortlinks->links() }}

    <form action="{{ route('link.delete') }}" method="POST" class="hidden" id="form-delete">
        @csrf
        <input type="hidden" name="id-delete" id="id-delete">
    </form>


    <script>
        //create sweelalert delete popup
        function deleteConfirm(id) {
            const form = document.getElementById('form-delete');
            form.querySelector('#id-delete').value = id;

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',

                showCancelButton: true,
                confirmButtonColor: '#3085d6',

                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                //if user click yes
                if (result.isConfirmed) {
                    // submit form using fetch
                    form.submit();
                }
            }).catch((error) => {
                console.log(error)
            })
        }


        function toEdit(id) {
            window.location.href = `mobile-edit/${id}`;
        }

        function copyShortlink(url) {
            //add url to clipboard
            navigator.clipboard.writeText(url);
        }
    </script>
</div>
