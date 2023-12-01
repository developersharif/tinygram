@push('cdn')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/chat/main.jsx'])
@endpush
<x-post.layout>
    <x-slot:content>
        @section('content')
            <section-middle>

                <div id="root"></div>

            </section-middle>
        @endsection
    </x-slot:content>
</x-post.layout>
