<form action="{{ $post->likedByUser() ? route('post.unlike', $post) : route('post.like', $post) }}"
    method="{{ $post->likedByUser() ? 'post' : 'get' }}">
    @csrf
    @method('POST')
    <button type="submit">
        @if (!$post->likedByUser())
            <i class="fa-regular fa-heart" title="like"></i>
        @else
            <i class="fa-solid fa-heart" style="color: #f32020;" title="unlike"></i>
        @endif
    </button>
</form>
