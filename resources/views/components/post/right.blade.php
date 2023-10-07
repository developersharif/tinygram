<section-right class=" p-4  hidden sm:block">
    <!-- Column 3 Content -->
    <div class=" w-52">
        <small class="text-gray-400">Suggested for you . <a href="">See All</a></small>
        <ul>
            @foreach ($suggestedUsers as $suggested_user)
                <li>
                    <div class="users-list flex items-center gap-2 p-2 hover:bg-gray-200">
                        <a href="{{ route('user.profile', $suggested_user->username) }}" class="text-sm">
                            <img src="{{ asset('storage/profile/' . $suggested_user->avatar) }}"
                                alt="{{ $suggested_user->name }}"
                                class="object-cover object-center w-8 h-8 rounded-full shadow-sm bg-coolGray-500 border-coolGray-700"
                                alt="username">
                            <p>{{ $suggested_user->name }}
                        </a></p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</section-right>
</div>
