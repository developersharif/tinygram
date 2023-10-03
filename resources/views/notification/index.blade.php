<x-post.layout>
    <x-slot:content>

        <div class="w-full h-full transform translate-x-0 transition ease-in-out duration-700" id="notification">
            <div class=" bg-gray-50 h-screen overflow-y-auto p-8">
                <div class="flex items-center justify-between">
                    <p tabindex="0" class="focus:outline-none text-xl font-semibold leading-6 text-gray-800">
                        Notifications</p>
                </div>

                @foreach ($notifications as $notification)
                    <div class="w-full p-3 mt-4 bg-white rounded shadow flex flex-shrink-0">
                        <div tabindex="0" aria-label="group icon" role="img"
                            class="focus:outline-none w-8 h-8 border rounded-full border-gray-200 flex flex-shrink-0 items-center justify-center">
                            <i class="fa-solid fa-heart" style="color: #db1f3b;"></i>
                        </div>
                        <div class="pl-3 w-full">
                            <div class="flex items-center justify-between w-full">
                                <a href="{{ route('post.show', $notification->data['postId']) }}?ref=notification"
                                    class="
                                    @if (!$notification->read_at) font-bold @endif
                                    ">
                                    <p tabindex="0" class="focus:outline-none text-sm leading-none"><span
                                            class="text-indigo-700">{{ $notification->data['message'] }} </p>
                                </a>
                                <div tabindex="0" aria-label="close icon" role="button"
                                    class="focus:outline-none cursor-pointer">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.5 3.5L3.5 10.5" stroke="#4B5563" stroke-width="1.25"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M3.5 3.5L10.5 10.5" stroke="#4B5563" stroke-width="1.25"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <p tabindex="0" class="focus:outline-none text-xs leading-3 pt-1 text-gray-500">
                                {{ $notification->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                @endforeach





            </div>
        </div>


    </x-slot:content>
</x-post.layout>
