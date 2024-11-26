@extends('admin.layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Author</h1>
            <form action="{{ route('admin.authors.update', $author) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
    
                <div class="mb-6">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Author Name</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', $author->name) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                           required>
                    @error('name')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
    
                <div class="mb-6">
                    <label for="bio" class="block text-gray-700 font-bold mb-2">Author Biography</label>
                    <textarea 
                        name="bio" 
                        id="bio" 
                        rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >{{ old('bio', $author->bio) }}</textarea>
                </div>
    
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Author Image</label>
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0 h-24 w-24">
                            @if($author->image_path)
                                <img 
                                    src="{{ "/storage/".$author->image_path }}" 
                                    alt="{{ $author->name }}"
                                    class="h-24 w-24 rounded-full object-cover"
                                    id="preview-image"
                                >
                            @else
                                <div class="h-24 w-24 rounded-full bg-gray-200 flex items-center justify-center">
                                    <svg class="h-12 w-12 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div>
                            <input 
                                type="file" 
                                name="image" 
                                id="image" 
                                accept="image/*"
                                class="hidden"
                                onchange="previewImage(event)"
                            >
                            <label for="image" 
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 cursor-pointer">
                                Choose New Image
                            </label>
                            @if($author->image_path)
                                <button 
                                    type="button" 
                                    onclick="removeImage()"
                                    class="ml-2 inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                    Remove Image
                                </button>
                            @endif
                        </div>
                    </div>
                    @error('image')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
    
                <div class="flex justify-end space-x-4 mt-6">
                    <a href="{{ route('admin.authors.index') }}" 
                       class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                        Cancel
                    </a>
                    <button 
                        type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Update Author
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview-image');
        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    function removeImage() {
        const input = document.getElementById('image');
        const preview = document.getElementById('preview-image');
        
        // Clear the file input
        input.value = '';
        
        // Hide or remove the preview image
        preview.src = '';
        preview.classList.add('hidden');
    }
</script>
@endpush
@endsection