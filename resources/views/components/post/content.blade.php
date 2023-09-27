        <section-middle class="container bg-white">
            @foreach ($posts as $post)
                <!--Post Card Start-->
                <div>
                    <div>
                        <div class="p-3 px-6 min-h-48 flex justify-center items-center" style="cursor: auto;">
                            <custom-card3>
                                <div class="rounded-md shadow-md sm:w-96 bg-coolGray-900 text-coolGray-100">
                                    <div class="flex items-center justify-between p-3" style="cursor: auto;">
                                        <div class="flex items-center space-x-2" style="cursor: auto;">
                                            <img src="{{ asset('storage/profile/' . $post->user->avatar) }}"
                                                alt=""
                                                class="object-cover object-center w-8 h-8 rounded-full shadow-sm bg-coolGray-500 border-coolGray-700"
                                                style="cursor: auto;">
                                            <div class="-space-y-1" style="cursor: auto;">
                                                <h2 class="text-sm font-semibold leading-none" style="cursor: auto;">
                                                    {{ $post->user->name }}</h2>
                                                <span class="inline-block text-xs leading-none text-coolGray-400"
                                                    style="cursor: auto;">{{ $post->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        @can('update', $post)
                                            <details class="dropdown dropdown-end">
                                                <summary class="m-1 ">
                                                </summary>
                                                <ul
                                                    class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52">
                                                    <li><a href="{{ route('post.edit', $post->id) }}"><i
                                                                class="fa-regular fa-pen-to-square"></i> Edit</a></li>
                                                    <li>
                                                        <form method="POST"
                                                            action="{{ route('post.destroy', $post->id) }}">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                onclick="return confirm('Are you sure you want to delete this resource?')"><i
                                                                    class="fa-solid fa-trash-can"></i> Delete</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </details>
                                        @endcan
                                    </div>
                                    <img src="{{ asset('storage/photos/' . $post->image) }}"
                                        class="object-cover object-center w-full h-72 bg-coolGray-500"
                                        style="cursor: auto;">
                                    <div class="p-3" style="cursor: auto;">
                                        <div class="flex items-center justify-between" style="cursor: auto;">
                                            <div class="flex items-center space-x-3">
                                                <button type="button" title="Like post"
                                                    class="flex items-center justify-center">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                                <button type="button" title="Add a comment"
                                                    class="flex items-center justify-center">
                                                    <i class="fa-regular fa-comment"></i>
                                                </button>
                                                <button type="button" title="Share post"
                                                    class="flex items-center justify-center">
                                                    <i class="fa-solid fa-retweet"></i>
                                                </button>
                                            </div>
                                            <button type="button" title="Bookmark post"
                                                class="flex items-center justify-center">
                                                <i class="fa-regular fa-bookmark"></i>
                                            </button>
                                        </div>
                                        <div class="flex flex-wrap items-center pt-3 pb-1" style="cursor: auto;">
                                            <div class="flex items-center space-x-2">
                                                <div class="flex -space-x-1">
                                                    <img alt=""
                                                        class="w-5 h-5 border rounded-full bg-coolGray-500 border-coolGray-800"
                                                        src="{{ asset('storage/profile/' . $post->user->avatar) }}">
                                                    <img alt=""
                                                        class="w-5 h-5 border rounded-full bg-coolGray-500 border-coolGray-800"
                                                        src="https://stackdiary.com/140x100.png">
                                                    <img alt=""
                                                        class="w-5 h-5 border rounded-full bg-coolGray-500 border-coolGray-800"
                                                        src="{{ asset('storage/profile/' . $post->user->avatar) }}"><!---->
                                                </div>
                                                <span class="text-sm"> Liked by
                                                    <span class="font-semibold">Pixels</span> and
                                                    <span class="font-semibold">20 others</span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="space-y-3" style="cursor: auto;">
                                            <p class="text-sm" style="cursor: auto;">
                                                <span class="text-base font-semibold">{{ $post->user->name }}</span>
                                                {{ $post->body }}
                                            </p>
                                            <input type="text" placeholder="Add a comment..."
                                                class="w-full py-0.5 bg-transparent border-none rounded text-sm pl-0 text-coolGray-100"
                                                style="cursor: auto;">
                                        </div>
                                    </div>
                                </div>
                            </custom-card3>
                        </div>
                    </div>
                </div>
            @endforeach
        </section-middle>
