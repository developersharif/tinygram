<div class="comment-thread">
    @foreach ($comments as $comment)
        <!-- Comment 1 start -->
        <details open class="comment" id="comment-{{ $comment->id }}">
            <a href="#comment-1" class="comment-border-link">
                <span class="sr-only">Jump to comment-1</span>
            </a>
            <summary>
                <div class="comment-heading">
                    <div class="comment-voting">
                        <button type="button">
                            <span aria-hidden="true">&#9650;</span>
                            <span class="sr-only">Vote up</span>
                        </button>
                        <button type="button">
                            <span aria-hidden="true">&#9660;</span>
                            <span class="sr-only">Vote down</span>
                        </button>
                    </div>
                    <div class="comment-info">
                        <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                            <a href="{{ route('user.profile', $comment->user->username) }}"
                                class="comment-author">{{ $comment->user->name }} </a>
                            @method('DELETE')
                            @csrf
                            @can('delete', $comment)
                                &bull; <button type="submit" class="text-[12px] underline">Delete</button>
                            @endcan

                            <p class="m-0">
                                {{ $comment->updated_at->diffForHumans() }}
                            </p>
                        </form>
                    </div>
                </div>

            </summary>

            <div class="comment-body">
                <p>
                    {{ $comment->content }}
                </p>
                <button type="button" data-toggle="reply-form" data-target="comment-{{ $comment->id }}-reply-form"
                    class="btn btn-xs">Reply</button>
                <!-- Reply form start -->
                <form action="{{ route('comment.reply', $comment->id) }}" method="POST" class="reply-form d-none"
                    id="comment-{{ $comment->id }}-reply-form">
                    @csrf
                    <input type="hidden" name="parent_comment_id" value="{{ $comment->id }}">
                    <input type="hidden" name="post_id" value="{{ $comment->post_id }}">
                    <textarea name="content" placeholder="Reply to comment" rows="4"></textarea>
                    <button type="submit" class="btn btn-xs">Submit</button>
                    <button type="button" data-toggle="reply-form"
                        data-target="comment-{{ $comment->id }}-reply-form" class="btn btn-xs">Cancel</button>
                </form>
                <!-- Reply form end -->
            </div>
            @if ($comment->childComments->count() > 0)
                @include('components.comment.view', ['comments' => $comment->childComments])
            @endif
        </details>
        <!-- Comment 1 end -->
    @endforeach
</div>
