@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Authors</h1>
            <p class="mt-2 text-gray-600">Manage your book authors</p>
        </div>
        <a href="{{ route('admin.authors.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add New Author
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="min-w-full divide-y divide-gray-200">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 p-4">
                @forelse($authors as $author)
                    <div class="bg-white overflow-hidden border rounded-lg hover:shadow-lg transition-shadow duration-300">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-16 w-16">
                                    @if($author->image_path)
                                        <img class="h-16 w-16 rounded-full object-cover" 
                                             src="{{ Storage::url($author->image_path) }}" 
                                             alt="{{ $author->name }}">
                                    @else
                                        <div class="h-16 w-16 rounded-full bg-gray-200 flex items-center justify-center">
                                            <svg class="h-8 w-8 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">{{ $author->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $author->books_count }} {{ Str::plural('book', $author->books_count) }}</p>
                                </div>
                            </div>
                            
                            @if($author->bio)
                                <div class="mt-4">
                                    <p class="text-sm text-gray-600 line-clamp-3">{{ $author->bio }}</p>
                                </div>
                            @endif

                            <div class="mt-4 flex justify-end space-x-3">
                                <a href="{{ route('admin.authors.edit', $author) }}" 
                                   class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Edit
                                </a>
                                <form action="{{ route('admin.authors.destroy', $author) }}" 
                                      method="POST" 
                                      class="inline-block"
                                      onsubmit="return confirm('Are you sure you want to delete this author? This will also delete all associated books.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No authors found</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new author.</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.authors.create') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                Add New Author
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        
        <div class="px-6 py-4 bg-gray-50">
            {{ $authors->links() }}
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Add smooth fade out for flash messages
    const flashMessage = document.querySelector('[role="alert"]');
    if (flashMessage) {
        setTimeout(() => {
            flashMessage.style.transition = 'opacity 1s ease-out';
            flashMessage.style.opacity = '0';
            setTimeout(() => flashMessage.remove(), 1000);
        }, 3000);
    }
</script>
@endpush
@endsection