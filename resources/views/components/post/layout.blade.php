@extends('layouts.main')
@section('left-side')
    <x-post.left />
@endsection

@section('content')
    <section-middle class=" bg-gray-100">
        <div class="container">
            <div>
                <div class="p-3 px-6 min-h-48 flex justify-center items-center" style="cursor: auto;">
                    {{ $content }}
                </div>
            </div>
        </div>
    </section-middle>
@endsection

@section('right-side')
    <x-post.right :suggestedUsers="$users" />
@endsection
