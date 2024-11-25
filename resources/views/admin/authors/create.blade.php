@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-900">Add New Author</h1>
            <a href="{{ route('admin.authors.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium">
                Back to Authors
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-sm">
            <form action="{{ route('admin.authors.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 p-6">
                @csrf

                <div class="space-y-4">
                    {{-- Name Field --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Author Name</label>
                        <input type="text" name="name" id="name" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            value="{{ old('name') }}" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Bio Field --}}
                    <div>
                        <label for="bio" class="block text-sm font-medium text-gray-700">Biography</label>
                        <textarea name="bio" id="bio" rows="4" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('bio') }}</textarea>
                        @error('bio')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Image Upload --}}
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">Author Image</label>
                        <div class="mt-1 flex items-center">
                            <div class="preview-wrapper hidden mb-3">
                                <img id="preview" class="h-32 w-32 object-cover rounded-lg">
                            </div>
                        </div>
                        <div class="mt-1">
                            <input type="file" name="image" id="image" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-6 border-t">
                    <button type="reset" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Reset Form
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                        Create Author
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Image preview functionality
    document.getElementById('image').addEventListener('change', function(e) {
        const preview = document.getElementById('preview');
        const previewWrapper = document.querySelector('.preview-wrapper');
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewWrapper.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            previewWrapper.classList.add('hidden');
        }
    });
</script>
@endpush
@endsection

