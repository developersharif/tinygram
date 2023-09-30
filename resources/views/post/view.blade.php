<x-post.layout>
    <x-slot:content>
        <style>
            .comment-thread {
                width: 100%;
                max-width: 100%;
                margin: auto;
                padding: 0 30px;
                background-color: #fff;
                border: 1px solid transparent;
                /* Removes margin collapse */
            }

            .m-0 {
                margin: 0;
            }

            .sr-only {
                position: absolute;
                left: -10000px;
                top: auto;
                width: 1px;
                height: 1px;
                overflow: hidden;
            }

            /* Comment */

            .comment {
                position: relative;
                margin: 20px auto;
            }

            .comment-heading {
                display: flex;
                align-items: center;
                height: 50px;
                font-size: 14px;
            }

            .comment-voting {
                width: 20px;
                height: 32px;
                border: 1px solid rgba(0, 0, 0, 0.2);
                border-radius: 4px;
            }

            .comment-voting button {
                display: block;
                width: 100%;
                height: 50%;
                padding: 0;
                border: 0;
                font-size: 10px;
            }

            .comment-info {
                color: rgba(0, 0, 0, 0.5);
                margin-left: 10px;
            }

            .comment-author {
                color: rgba(0, 0, 0, 0.85);
                font-weight: bold;
                text-decoration: none;
            }

            .comment-author:hover {
                text-decoration: underline;
            }

            .replies {
                margin-left: 20px;
            }

            /* Adjustments for the comment border links */

            .comment-border-link {
                display: block;
                position: absolute;
                top: 50px;
                left: 8px;
                width: 4px;
                height: calc(100% - 50px);
                border-left: 2px solid #0000000a;
                border-right: 2px solid #0000000a;
                background-color: rgba(0, 0, 0, 0.1);
                background-clip: padding-box;
            }

            .comment-border-link:hover {
                background-color: rgba(0, 0, 0, 0.3);
            }

            .comment-body {
                padding: 0 20px;
                padding-left: 28px;
            }

            .replies {
                margin-left: 28px;
            }

            /* Adjustments for toggleable comments */

            details.comment summary {
                position: relative;
                list-style: none;
                cursor: pointer;
            }

            details.comment summary::-webkit-details-marker {
                display: none;
            }

            details.comment:not([open]) .comment-heading {
                border-bottom: 1px solid rgba(0, 0, 0, 0.2);
            }

            .comment-heading::after {
                display: inline-block;
                position: absolute;
                right: 5px;
                align-self: center;
                font-size: 12px;
                color: rgba(0, 0, 0, 0.55);
            }

            details.comment[open] .comment-heading::after {
                content: "Click to hide";
            }

            details.comment:not([open]) .comment-heading::after {
                content: "Click to show";
            }

            /* Adjustment for Internet Explorer */

            @media screen and (-ms-high-contrast: active),
            (-ms-high-contrast: none) {

                /* Resets cursor, and removes prompt text on Internet Explorer */
                .comment-heading {
                    cursor: default;
                }

                details.comment[open] .comment-heading::after,
                details.comment:not([open]) .comment-heading::after {
                    content: " ";
                }
            }

            /* Styling the reply to comment form */

            .reply-form textarea {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
                font-size: 16px;
                width: 100%;
                max-width: 100%;
                margin-top: 15px;
                margin-bottom: 5px;
            }

            .d-none {
                display: none;
            }
        </style>
        <div class="mb-16">
            <div class="p-3 px-6 min-h-48 flex justify-center items-center bg-white">
                <custom-card>
                    <div
                        class="rounded-md shadow-md sm:w-96 bg-coolGray-900 text-coolGray-100 hover:shadow-none hover:bg-gray-50">
                        <div class="flex items-center justify-between p-3">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('user.profile', $post->user->username) }}">
                                    <img src="{{ asset('storage/profile/' . $post->user->avatar) }}" alt=""
                                        class="object-cover object-center w-8 h-8 rounded-full shadow-sm bg-coolGray-500 border-coolGray-700" />
                                </a>
                                <div class="-space-y-1 cursor-pointer">
                                    <a href="{{ route('user.profile', $post->user->username) }}">
                                        <h2 class="text-sm font-semibold leading-none">
                                            {{ $post->user->name }}</h2>
                                    </a>
                                    <span
                                        class="inline-block text-xs leading-none text-coolGray-400">{{ $post->created_at->diffForHumans() }}</span>
                                </div>

                            </div>
                            @can('update', $post)
                                <details class="dropdown dropdown-end">
                                    <summary class="m-1 ">
                                    </summary>
                                    <ul class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52">
                                        <li><a href="{{ route('post.edit', $post->id) }}"><i
                                                    class="fa-regular fa-pen-to-square"></i> Edit</a></li>
                                        <li>
                                            <form method="POST" action="{{ route('post.destroy', $post->id) }}">
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
                            class="object-cover object-center block h-auto w-full  bg-coolGray-500"
                            style="cursor: auto;">
                        <div class="p-3" style="cursor: auto;">
                            <div class="flex items-center justify-between" style="cursor: auto;">
                                <div class="flex items-center space-x-3">
                                    <button type="button" title="Like post" class="flex items-center justify-center">
                                        <x-like-button :post="$post" />

                                    </button>
                                    <button type="button" title="Add a comment"
                                        class="flex items-center justify-center">
                                        <a href="{{ route('post.show', $post->id) }}"><i
                                                class="fa-regular fa-comment"></i><span
                                                class="p-1 text-sm">{{ $post->comments()->count() }}</span></a>
                                    </button>
                                    <button type="button" title="Share post" class="flex items-center justify-center">
                                        <i class="fa-solid fa-retweet"></i>
                                    </button>
                                </div>
                                <button type="button" title="Bookmark post" class="flex items-center justify-center">
                                    <i class="fa-regular fa-bookmark"></i>
                                </button>
                            </div>
                            @if ($post->likedBy()->count() != 0)
                                <div class="flex flex-wrap items-center pt-3 pb-1" style="cursor: auto;">
                                    <div class="flex items-center space-x-2">
                                        <div class="flex -space-x-1">
                                            @foreach ($post->likedBy()->limit(3)->orderByDesc('id')->get() as $likedUser)
                                                <a href="{{ route('user.profile', $likedUser->username) }}">
                                                    <img alt=""
                                                        class="w-5 h-5 border rounded-full bg-coolGray-500 border-coolGray-800"
                                                        src="{{ asset('storage/profile/' . $likedUser->avatar) }}"></a>
                                            @endforeach



                                        </div>
                                        <span class="text-sm"> Liked by
                                            <span
                                                class="font-semibold">{{ $post->likedBy()->orderByDesc('id')->first()->name }}</span>
                                            @if ($post->likedBy()->count() > 1)
                                                and
                                                <span class="font-semibold">{{ $post->likedBy()->count() - 1 }}
                                                    others</span>
                                            @endif

                                        </span>
                                    </div>
                                </div>
                            @endif
                            <div class="space-y-3" style="cursor: auto;">
                                <p class="text-sm" style="cursor: auto;">
                                    <span class="text-base font-semibold">{{ $post->user->name }}</span>
                                    {{ $post->body }}
                                </p>

                                <form action="{{ route('comment.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}" required>
                                    <input type="text" placeholder="Add a comment..." name="content"
                                        class="md:w-[75%] w-full py-0.5 bg-transparent border-none rounded text-sm pl-0 text-coolGray-100"
                                        style="cursor: auto;">
                                    <input type="submit" name="submit" class="btn btn-outline btn-xs" value="Comment">
                                </form>
                            </div>
                        </div>
                    </div>
                </custom-card>
            </div>
            @include('components.comment.view', ['comments' => $comments])
        </div>
        <script type="text/javascript">
            document.addEventListener(
                "click",
                function(event) {
                    var target = event.target;
                    var replyForm;
                    if (target.matches("[data-toggle='reply-form']")) {
                        replyForm = document.getElementById(target.getAttribute("data-target"));
                        replyForm.classList.toggle("d-none");
                    }
                },
                false
            );
        </script>
    </x-slot:content>
</x-post.layout>
