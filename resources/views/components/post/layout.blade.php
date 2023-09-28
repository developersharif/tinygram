@extends('layouts.main')
@section('left-side')
    <x-post.left />
@endsection

@section('content')
    <section-middle class=" bg-gray-100 px-2">
        <div class="container">
            <div>
                <div class="w-full min-h-48 flex justify-center items-center">
                    {{ $content }}
                </div>
            </div>
        </div>
    </section-middle>
@endsection

@section('right-side')
    <x-post.right :suggestedUsers="$users" />
@endsection
