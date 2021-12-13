<x-layout>

    <x-setting :heading="'Edit Post: ' . $post->title">

        <form method="POST" action="/admin/posts/{{ $post->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="title" :value="old('title', $post->title)" />
            <x-form.input name="slug" :value="old('slug', $post->slug)" />
            <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $post->thumbnail)" />
            <x-form.textarea name="excerpt"> {{ old('excerpt', $post->excerpt) }}</x-form.textarea>
            <x-form.textarea name="body">{{ old('body', $post->body)}}</x-form.textarea>

            <div class="mb-6">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="category_id">CATEGORY</label>

                <select name="category_id" id="category_id" required>


                    @foreach (\App\models\category::all() as $category)

                        <option value="{{ $category->id }}"
                            {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                            {{ ucwords($category->name) }}
                        </option>

                    @endforeach

                </select>

                @error('category')

                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>

                @enderror

            </div>

            <x-submit-button>Update</x-submit-button>

        </form>

    </x-setting>

</x-layout>
