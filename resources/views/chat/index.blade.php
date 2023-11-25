@extends('layouts.main')
@push('cdn')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/chat/main.jsx'])
@endpush
@section('left-side')
    <x-post.left />
@endsection

@section('content')
    <section-middle class=" bg-gray-100 px-2">

        <div id="root"></div>

    </section-middle>
@endsection
