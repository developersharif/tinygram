<x-post.layout>
    <x-slot:content>
        <div class="container bg-white md:m-4 md:pl-4 w-full">
            <form action="{{ route('search') }}" method="get">
                <p class="py-4">
                    <input type="text" name="q" placeholder="Search..." class="input input-bordered  md:max-w-xs"
                        value="{{ request('q') }}" />
                    <span> <button type="submit" class="btn btn-outline">Search</button> </span>
                </p>
            </form>
        </div>
    </x-slot:content>
</x-post.layout>
