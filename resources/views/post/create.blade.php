<x-post.layout>
    <x-slot:content>
        <div x-data="{ image: '' }" class="container  my-4 md:w-[22.5rem] bg-white p-4">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert text-red-500">
                        <span>Error! {{ $error }}</span>
                    </div>
                @endforeach

            @endif
            <h3 class="p-4">Share your thoughts!?</h3>
            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data"
                class="form-control w-full mb-6">
                <textarea placeholder="Whats on your mind!?" name="body"
                    class="textarea textarea-bordered textarea-md w-full max-w-xs">{{ old('body') }}</textarea>
                <label for="postImage" class="cursor-pointer p-4 mx-auto">
                    <span class="border border-gray-300 rounded-md p-3">Choose Image</span>
                    <input type="file" name="photo" id="postImage" class="hidden"
                        @change="image = URL.createObjectURL($event.target.files[0])">
                </label>
                @csrf
                <div x-show="image">
                    <h2>Preview:</h2>
                    <i class="fa-solid fa-circle-xmark" style="color: #b92d2d;" @click="image = ''"></i>
                    <img :src="image" alt="Preview" style="max-width: 300px; max-height: 300px;"
                        class="p-4">
                </div>
                <div class="mx-auto">
                    <button class="btn btn-outline w-[10rem]" type="submit" value="submit"> Post </button>
                </div>
            </form>
        </div>
    </x-slot:content>
</x-post.layout>
