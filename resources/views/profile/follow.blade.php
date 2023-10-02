<x-post.layout>
    <x-slot:content>
        @php
            $users = isset($followers) ? $followers : $following;
            $label = isset($followers) ? 'Followers' : 'Following';
        @endphp
        {{-- profile content start --}}
        <main class="bg-white mb-16">

            <div class="">

                <header class="flex flex-wrap items-center p-4">

                    <div class="">
                        <!-- profile image -->
                        <img class="w-20 h-20 md:w-40 md:h-40 object-cover rounded-full
                     border-2 border-black p-1"
                            src="{{ asset('storage/profile/' . $user->avatar) }}" alt="profile">
                    </div>

                    <!-- profile meta -->
                    <div class="w-8/12 md:w-7/12 ml-4">
                        <div class="md:flex md:flex-wrap md:items-center mb-4">
                            <h2 class="text-base inline-block font-light md:mr-2 mb-2 sm:mb-0">
                                {{ $user->username }}
                            </h2>
                            <!-- badge -->
                            {{-- <i class="fa-solid fa-circle-check scale-90"></i> --}}
                            <!-- follow button -->
                            @if (auth()->user() != $user)
                                <form action="{{ route('user.follow', $user->id) }}" method="post">
                                    @csrf
                                    <input type="submit"
                                        value="{{ auth()->user()->isFollowing($user)? 'Unfollow': 'Follow' }}"
                                        class="bg-gray-800 px-2 py-1
                            text-white font-semibold text-sm rounded  text-center
                            sm:inline-block ml-1">
                                </form>
                            @endif

                        </div>

                        <!-- post, following, followers list for medium screens -->
                        <ul class="hidden md:flex space-x-8 mb-4">
                            <li>
                                <a href="{{ route('user.profile', $user->username) }}">
                                    <span class="font-semibold">{{ $user->posts()->count() }}</span>
                                    posts
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('user.follower', $user->username) }}">
                                    <span class="font-semibold">{{ $user->followers->count() }}</span>
                                    followers
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.following', $user->username) }}">
                                    <span class="font-semibold">{{ $user->followings->count() }}</span>
                                    following
                                </a>
                            </li>
                        </ul>

                        <!-- user meta form medium screens -->
                        <div class="hidden md:block">
                            <h1 class="font-semibold">{{ $user->name }}</h1>
                            <p>bio goes here</p>
                        </div>

                    </div>

                    <!-- user meta form small screens -->
                    <div class="md:hidden text-sm my-2">
                        <h1 class="font-semibold"> {{ $user->name }}</h1>
                        <p>Lorem ipsum dolor sit amet consectetur</p>
                    </div>

                </header>

                <!-- posts -->
                <div class="px-px md:px-3">

                    <!-- user following for mobile only -->
                    <ul
                        class="flex md:hidden justify-around space-x-8 border-t
                text-center p-2 text-gray-600 leading-snug text-sm">
                        <li>
                            <a href="{{ route('user.profile', $user->username) }}">
                                <span class="font-semibold">{{ $user->posts()->count() }}</span>
                                posts
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('user.follower', $user->username) }}">
                                <span class="font-semibold">{{ $user->followers->count() }}</span>
                                followers
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.following', $user->username) }}">
                                <span class="font-semibold">{{ $user->followings->count() }}</span>
                                following
                            </a>
                        </li>
                    </ul>

                    <!-- insta freatures -->
                    <ul
                        class="flex items-center justify-around md:justify-center space-x-12
                    uppercase tracking-widest font-semibold text-xs text-gray-600
                    border-t">
                        <!-- posts tab is active -->
                        <li class="md:border-t md:border-gray-700 md:-mt-px md:text-gray-700">
                            <a class="inline-block p-3" href="#">
                                <i class="fas fa-th-large text-xl md:text-xs"></i>
                                <span class="hidden md:inline">{{ $label }}</span>
                            </a>
                        </li>

                    </ul>
                    <!-- flexbox grid -->
                    <div class="">
                        <ul>
                            @foreach ($users as $follow)
                                <li>
                                    <div class="users-list flex items-center gap-2 p-2 hover:bg-gray-200">
                                        <a href="{{ route('user.profile', $follow->username) }}" class="text-sm">
                                            <img src="{{ asset('storage/profile/' . $follow->avatar) }}"
                                                alt="{{ $follow->name }}"
                                                class="object-cover object-center w-8 h-8 rounded-full shadow-sm bg-coolGray-500 border-coolGray-700"
                                                alt="username">
                                            <p>{{ $follow->name }}
                                        </a></p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </main>
        {{-- profile content end --}}
    </x-slot:content>
</x-post.layout>
