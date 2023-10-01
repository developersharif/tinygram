@php
    $easyFormat = function ($n) {
        if ($n < 1000) {
            return $n;
        }
    
        $suffix = ['', 'k', 'M', 'B', 'T', 'Q'];
    
        $power = min(floor(log($n, 1000)), count($suffix) - 1);
    
        return round($n / 1000 ** $power, 2) . $suffix[$power];
    };
    $likes = $post->likedBy()->count() > 0 ? $easyFormat($post->likedBy()->count()) : null;
@endphp
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
        {{ $likes }}
    </button>
</form>
