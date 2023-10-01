<x-post.layout>
    <x-slot:content>
        <div class="container bg-white md:m-4 md:pl-4 w-full">
            <form action="{{ route('search') }}" method="get">
                <p class="py-4">
                    <input type="text" name="q" placeholder="Search..." class="input input-bordered  md:max-w-xs"
                        value="{{ request('q') }}" />
                    <span> <button type="submit" class="btn btn-outline">Search</button> </span>
                </p>
            </form>
            <ul>
                @if ($users->count() == 0)
                    <p class="text-center pb-3"> Not Found!</p>
                @endif
                @foreach ($users as $user)
                    <li>
                        <div class="users-list flex items-center md:gap-2 p-2 hover:bg-gray-200">
                            <a href="{{ route('user.profile', $user->username) }}" class="text-sm">
                                <img src="{{ asset('storage/profile/' . $user->avatar) }}" alt="{{ $user->name }}"
                                    class="object-cover object-center w-8 h-8 rounded-full shadow-sm bg-coolGray-500 border-coolGray-700"
                                    alt="username">
                                <p>{{ $user->name }}
                            </a></p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </x-slot:content>
</x-post.layout>
