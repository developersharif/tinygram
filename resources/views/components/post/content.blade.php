@php
    $easyFormat = function ($n) {
        if ($n < 1000) {
            return $n;
        }
        $suffix = ['', 'k', 'M', 'B', 'T', 'Q'];
        $power = min(floor(log($n, 1000)), count($suffix) - 1);
        return round($n / 1000 ** $power, 2) . $suffix[$power];
}; @endphp
<section-middle class="container bg-white mb-10">
    @if ($posts->count() <= 0)
        <div class="container bg-white alert">
            Your Following List is Empty Now!
        </div>
    @else
        @foreach ($posts as $post)
            @include('components.post.single-post', ['post' => $post])
        @endforeach
        {{-- infinityScroll component start --}}
        <div x-data="infiniteScrollData()" x-init="init()">
            <div x-show="!finished">
                <!-- Your data here -->
                <template x-for="post in posts" :key="post.id">


                    <div class="p-3 px-6 min-h-48 flex justify-center items-center">
                        <custom-card>
                            <div
                                class="rounded-md shadow-md sm:w-96 bg-coolGray-900 text-coolGray-100 hover:shadow-none hover:bg-gray-50">
                                <div class="flex items-center justify-between p-3">
                                    <div class="flex items-center space-x-2">
                                        <a :href="'{{ route('user.profile', '') }}/' + post.user.username">
                                            <img :src="'{{ asset('storage/profile') }}/' + post.user.avatar"
                                                alt=""
                                                class="object-cover object-center w-8 h-8 rounded-full shadow-sm bg-coolGray-500 border-coolGray-700"
                                                loading="lazy" />
                                        </a>
                                        <div class="-space-y-1 cursor-pointer">
                                            <a :href="'{{ route('user.profile', '') }}/' + post.user.username">
                                                <h2 class="text-sm font-semibold leading-none" x-text="post.user.name">
                                                </h2>
                                            </a>
                                            <span class="inline-block text-xs leading-none text-coolGray-400"
                                                x-text="timeAgo(post.created_at)"></span>
                                        </div>

                                    </div>
                                </div>
                                <a :href="'{{ route('post.show', '') }}/' + post.id"> <img
                                        :src="'{{ asset('storage/photos/' . '') }}/' + post.image"
                                        class="object-cover object-center block h-auto w-full  bg-coolGray-500"
                                        loading="lazy"></a>
                                <div class="p-3" style="cursor: auto;">
                                    <div class="flex items-center justify-between" style="cursor: auto;">
                                        <div class="flex items-center space-x-3">
                                            <div type="button" title="Like post"
                                                class="flex items-center justify-center">
                                                {{-- like button start --}}
                                                <form
                                                    x-bind:action="isLiked(post.liked_by, userId) ? '{{ route('post.like', '') }}/' +
                                                        post.id :
                                                        '{{ route('post.unlike', '') }}/' + post.id"
                                                    x-bind:method="isLiked(post.liked_by, userId) ? 'post' : 'get'">
                                                    @csrf
                                                    <button type="submit">
                                                        <i x-show="!isLiked(post.liked_by,userId)"
                                                            class="fa-regular fa-heart" title="like"></i>
                                                        <i x-show="isLiked(post.liked_by,userId)"
                                                            class="fa-solid fa-heart" style="color: #f32020;"
                                                            title="unlike"></i>
                                                        <likeCounter x-text="post.liked_by_count"></likeCounter>
                                                    </button>
                                                </form>
                                                {{-- like button end --}}
                                            </div>
                                            <button type="button" title="Add a comment"
                                                class="flex items-center justify-center">
                                                <a href="{{ route('post.show', $post->id) }}"><i
                                                        class="fa-regular fa-comment"></i><span class="p-1 text-sm"
                                                        x-show="post.comments_count > 0"
                                                        x-text="post.comments_count"></span></a>
                                            </button>

                                        </div>
                                        <button type="button" title="Bookmark post"
                                            class="flex items-center justify-center">
                                            <i class="fa-regular fa-bookmark"></i>
                                        </button>
                                    </div>

                                    <div x-show="post.liked_by_count > 0" class="flex flex-wrap items-center pt-3 pb-1"
                                        style="cursor: auto;">
                                        <div class="flex items-center space-x-2">
                                            <div class="flex -space-x-1">

                                                <a x-show="post?.liked_by[0]?.name"
                                                    :href="'{{ route('user.profile', '') }}' + post.liked_by[0].username">
                                                    <img class="w-5 h-5 border rounded-full bg-coolGray-500 border-coolGray-800"
                                                        :src="'{{ asset('storage/profile/' . '') }}/' + post.liked_by[0]
                                                            .avatar">
                                                </a>

                                                <a x-show="post?.liked_by[1]?.name"
                                                    :href="'{{ route('user.profile', '') }}' + post.liked_by[1].username">
                                                    <img class="w-5 h-5 border rounded-full bg-coolGray-500 border-coolGray-800"
                                                        :src="'{{ asset('storage/profile/' . '') }}/' + post.liked_by[1]
                                                            .avatar"></a>
                                                <a x-show="post?.liked_by[2]?.name"
                                                    :href="'{{ route('user.profile', '') }}' + post.liked_by[2].username">
                                                    <img class="w-5 h-5 border rounded-full bg-coolGray-500 border-coolGray-800"
                                                        :src="'{{ asset('storage/profile/' . '') }}/' + post.liked_by[2]
                                                            .avatar"></a>

                                            </div>
                                            <span x-show="post.liked_by[0]" class="text-sm"> Liked by
                                                <span class="font-semibold" x-text="post.liked_by[0].name"></span>
                                                <span x-show="post.liked_by_count > 1"
                                                    x-text="'and ' + (post.liked_by_count - 1) + ' others'"></span>
                                            </span>
                                        </div>
                                    </div>

                                    <a :href="'{{ route('post.show', '') }}/' + post.id">
                                        <div class="space-y-3">
                                            <span class="text-sm" x-text="post.user.name">
                                            </span><span class="text-base font-semibold"
                                                x-text="post.body.substr(0, 20)"></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </custom-card>
                    </div>


                </template>
                <!-- Loading Indicator -->
                <div class="text-center text-gray-200" x-show="loading">Loading...</div>
            </div>
            <div class="text-center text-gray-300 mb-8" x-show="finished">
                No more data to load
                @if (request()->getHost() !== 'localhost')
                    <a href="about" target="_blank" class="text-blue-400 text-xs"> 🍵 Donate</a>
                @endif

            </div>
        </div>
        {{-- infinityScroll component end --}}
    @endif
    <script>
        function infiniteScrollData() {
            return {
                userId: {{ auth()->id() }},
                posts: [],
                loading: false,
                finished: false,
                nextPageUrl: "{!! route('posts.api', ['page' => 2]) !!}",
                init() {
                    window.onscroll = () => {
                        const scrollHeight = document.documentElement.scrollHeight;
                        const scrollPosition = window.scrollY + window.innerHeight;
                        const scrollPercentage = Math.round((scrollPosition / scrollHeight) * 100);
                        if (scrollPercentage >= 80) {
                            this.loadMore();
                        }
                    };
                },
                loadMore() {
                    if (this.loading || this.finished) return;
                    if (this.nextPageUrl) {
                        this.loading = true;
                        fetch(this.nextPageUrl)
                            .then(response => response.json())
                            .then(data => {
                                this.loading = false;
                                if (data.data.length === 0) {
                                    this.finished = true;
                                } else {
                                    this.posts = [...this.posts, ...data.data];
                                    this.nextPageUrl = data.next_page_url;
                                }
                            });
                    }
                    if (this.nextPageUrl === null) {
                        this.finished = true;
                    }
                },
            };
        }
    </script>

</section-middle>
