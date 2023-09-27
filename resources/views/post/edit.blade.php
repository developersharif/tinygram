<x-post.layout>
    <x-slot:content>
        {{-- <x-post.content :$posts /> --}}
        <!-- You can open the modal using ID.showModal() method -->
        <div x-data="{ image: '{{ asset('storage/photos/' . $post->image) }}' }">
            <form action="{{ route('post.update', $post) }}" method="post" enctype="multipart/form-data"
                class="form-control">
                @method('PUT')
                <textarea placeholder="Whats on your mind!?" name="body" class="textarea textarea-bordered textarea-md w-full max-w-xs">{{ $post->body }}</textarea>
                <input type="file" name="photo" accept="image/*"
                    @change="image = URL.createObjectURL($event.target.files[0])"
                    class="file-input file-input-bordered file-input-md w-full max-w-xs">
                @csrf
                <div x-show="image">
                    <h2>Image Preview:</h2>
                    <img :src="image" alt="Preview" style="max-width: 300px; max-height: 300px;">
                    <i class="fa-solid fa-circle-xmark" style="color: #b92d2d;" @click="image = ''"></i>
                </div>
                <button class="btn btn-outline" type="submit" value="submit"> Update </button>
            </form>
        </div>
    </x-slot:content>
</x-post.layout>
