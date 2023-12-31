<div class="container mx-auto grid grid-flow-col gap-1 mb-2 md:w-[85%]">
    <section-left class="p-4  hidden sm:block">
        <!-- Column 1 Content -->
        <div class="sm:w-60 min-h-screen w-14 pt-2 transition-all md:sticky md:top-0 ">
            <div class="text-center text-black p-4">
                <a href="{{ route('home') }}"><img class="w-20" src="{{ asset('storage/images/tinygramlogo.png') }}"
                        alt="tinygramLogo" /></a>
            </div>
            <ul class="mt-1">
                <li
                    class="hover:bg-gray-200 hover:text-gray-800 cursor-pointer sm:justify-start px-4 h-12 flex items-center justify-center active">

                    <i class="fa-solid fa-house"></i>
                    <a href="{{ route('home') }}">
                        <span class="ml-3 hidden sm:block  font-semibold tracking-wide">
                            Home</span></a>
                </li>
                <li
                    class="hover:bg-gray-200 hover:text-gray-800 cursor-pointer sm:justify-start px-4 h-12 flex items-center justify-center relative">

                    <i class="fa-regular fa-bell"></i>
                    <a href="{{ route('user.notifications') }}">
                        @if (auth()->user()->unreadNotifications()->count() > 0)
                            <sup class="badge bg-red-600  text-white scale-75 absolute top-1 left-4">

                                {{ auth()->user()->unreadNotifications()->count() }}
                            </sup>
                        @endif
                        <span class="ml-3 hidden sm:block font-semibold tracking-wide">
                            Notification
                        </span>
                    </a>
                </li>

                <li class="hover:bg-gray-200 hover:text-gray-800 cursor-pointer sm:justify-start px-4 h-12 flex items-center justify-center"
                    onclick="searchModal.showModal()">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span class="ml-3 hidden sm:block  font-semibold tracking-wide ">
                        Search</span>
                    <dialog id="searchModal" class="modal">
                        <div class="modal-box">
                            <h3 class="font-bold text-lg">Search!</h3>

                            <form action="{{ route('search') }}" method="get">
                                <p class="py-4">
                                    <input type="text" name="q" placeholder="Search..."
                                        class="input input-bordered w-full max-w-xs" />
                                    <span> <button type="submit" class="btn btn-outline">Search</button> </span>
                                </p>
                            </form>

                        </div>
                        <form method="dialog" class="modal-backdrop">
                            <button>close</button>
                        </form>
                    </dialog>
                </li>
                <li
                    class="hover:bg-gray-200 hover:text-gray-800 cursor-pointer sm:justify-start px-4 h-12 flex items-center justify-center relative">

                    <i class="fa-regular fa-message"></i>
                    <a href="{{ route('user.chat') }}" id="message-href">
                        @if (auth()->user()->countUnseenMessages() > 0)
                            <sup class="badge bg-red-600  text-white scale-75 absolute top-1 left-4"
                                id="message-indicator">

                                {{ auth()->user()->countUnseenMessages() }}
                            </sup>
                        @endif
                        <span class="ml-3 hidden sm:block font-semibold tracking-wide">
                            Message
                        </span>
                    </a>
                </li>
                <li class="hover:bg-gray-200 hover:text-gray-800 cursor-pointer sm:justify-start px-4 h-12 flex items-center justify-center"
                    onclick="my_modal_5.showModal()">
                    <i class="fa-regular fa-square-plus"></i>
                    <span class="ml-3 hidden sm:block font-semibold tracking-wide">
                        Create</span>
                    <dialog id="my_modal_5" class="modal modal-bottom sm:modal-middle">
                        <div class="modal-box text-black">
                            <h3 class="font-bold text-lg">Share your thoughts!?</h3>
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-error">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Error! {{ $error }}.</span>
                                    </div>
                                @endforeach

                            @endif
                            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                                <p class="py-4">
                                    <textarea name="body" placeholder="Whats On Your Mind!"
                                        class="textarea textarea-bordered textarea-lg w-full max-w-xs"></textarea>
                                <div x-data="{ imagePreview: '' }" class="mb-5">
                                    <label for="fileInput" class="cursor-pointer">
                                        <span class="border border-gray-300 p-2 rounded-md">Choose Image</span>
                                        <input type="file" name="photo" id="fileInput" class="hidden"
                                            @change="imagePreview = URL.createObjectURL($event.target.files[0])">
                                    </label>

                                    <div x-show="imagePreview">
                                        <img :src="imagePreview" alt="Image Preview" class="mt-4 max-w-xs">
                                        <i class="fa-solid fa-circle-xmark" style="color: #b92d2d;"
                                            @click="imagePreview = ''"></i>
                                    </div>
                                </div>
                                @csrf
                                </p>
                                <button type="submit" class="btn btn-outline">Post</button>
                            </form>

                            <div class="modal-action">
                                <form method="dialog">
                                    <!-- if there is a button in form, it will close the modal -->
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                            </div>
                        </div>
                    </dialog>
                </li>
                <li
                    class="hover:bg-gray-200 hover:text-gray-800 cursor-pointer sm:justify-start px-4 h-12 flex items-center justify-center">

                    <i class="fa-regular fa-user"></i>
                    <a href="{{ route('user.profile', auth()->user()->username) }}"> <span
                            class="ml-3 hidden sm:block font-semibold tracking-wide ">
                            Profile</span> </a>

                </li>
                <li class="sm:justify-start px-4 h-12 flex items-center justify-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                            class="underline text-sm text-gray-600  rounded-md focus:outline-none dark:focus:ring-offset-gray-800">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> {{ __('Log Out') }}
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </section-left>
    <section-left-mobile class="block md:hidden fixed bottom-0 w-full z-50">
        <ul class="menu flex flex-row justify-between rounded-box mt-6 w-full space-x-0 backdrop-blur-md text-lg">
            <li>
                <a class="tooltip" data-tip="Home" href="{{ route('home') }}">
                    <i class="fa-solid fa-house"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('search') }}" class="tooltip" data-tip="Search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>
            </li>
            <li>
                <a class="tooltip" data-tip="Create Post" href="{{ route('post.create') }}">
                    <i class="fa-regular fa-square-plus"></i>
                </a>
            </li>
            <li>
                <a class="tooltip" data-tip="Message" href="{{ route('user.chat', auth()->user()->username) }}"
                    id="message-href-mobile">
                    <i class="fa-regular fa-message"></i>
                    @if (auth()->user()->countUnseenMessages() > 0)
                        <sup class="badge bg-red-600  text-white scale-75 absolute top-1 left-4"
                            id="message-indicator-mobile">

                            {{ auth()->user()->countUnseenMessages() }}
                        </sup>
                    @endif
                </a>
            </li>
            <li>
                <a class="tooltip" data-tip="Notification" href="{{ route('user.notifications') }}">
                    <i class="fa-regular fa-bell"></i>
                    @if (auth()->user()->unreadNotifications()->count() > 0)
                        <sup class="badge bg-red-600  text-white scale-75 absolute top-1 left-4">

                            {{ auth()->user()->unreadNotifications()->count() }}
                        </sup>
                    @endif
                </a>
            </li>

            <li>
                <a class="tooltip" data-tip="Menu" href="{{ route('user.profile', auth()->user()->username) }}">
                    <i class="fa-solid fa-bars-staggered"></i>
                </a>
            </li>

        </ul>
    </section-left-mobile>
