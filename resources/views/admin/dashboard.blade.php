@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    <!-- Books Stats -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Books</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $totalBooks ?? 0 }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
                <a href="{{ route('admin.books.index') }}" class="font-medium text-indigo-600 hover:text-indigo-900">View all books</a>
            </div>
        </div>
    </div>

    <!-- Authors Stats -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Authors</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $totalAuthors ?? 0 }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
                <a href="{{ route('admin.authors.index') }}" class="font-medium text-green-600 hover:text-green-900">View all authors</a>
            </div>
        </div>
    </div>

    <!-- Genres Stats -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Genres</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $totalGenres ?? 0 }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
                <a href="{{ route('admin.genres.index') }}" class="font-medium text-yellow-600 hover:text-yellow-900">View all genres</a>
            </div>
        </div>
    </div>

    <!-- Downloads Stats -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Downloads</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $totalDownloads ?? 0 }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
                <a href="#" class="font-medium text-purple-600 hover:text-purple-900">View statistics</a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity Section -->
<div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-4">
    <!-- Recent Books -->
    <div class="bg-white shadow rounded-lg">
        <div class="p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Recently Added Books</h3>
            <div class="mt-5">
                <div class="flow-root">
                    <ul role="list" class="-my-5 divide-y divide-gray-200">
                        @forelse($recentBooks ?? [] as $book)
                        <li class="py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="h-8 w-8 rounded-full" src="{{ "/storage/".$book->image_path ?? 'https://via.placeholder.com/40' }}" alt="{{ $book->title }}">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $book->title }}</p>
                                    <p class="text-sm text-gray-500 truncate">By {{ $book->author->name }}</p>
                                </div>
                                <div>
                                    <a href="{{ route('admin.books.edit', $book) }}" class="inline-flex items-center shadow-sm px-2.5 py-0.5 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="py-4">
                            <div class="text-center text-gray-500">No books added recently</div>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Authors -->
    <div class="bg-white shadow rounded-lg">
        <div class="p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Recently Added Authors</h3>
            <div class="mt-5">
                <div class="flow-root">
                    <ul role="list" class="-my-5 divide-y divide-gray-200">
                        @forelse($recentAuthors ?? [] as $author)
                        <li class="py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="h-8 w-8 rounded-full" src="{{ "/storage/".$author->image_path ?? 'https://via.placeholder.com/40' }}" alt="{{ $author->name }}">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $author->name }}</p>
                                    <p class="text-sm text-gray-500 truncate">{{ $author->books_count ?? 0 }} books</p>
                                </div>
                                <div>
                                    <a href="{{ route('admin.authors.edit', $author) }}" class="inline-flex items-center shadow-sm px-2.5 py-0.5 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="py-4">
                            <div class="text-center text-gray-500">No authors added recently</div>
                        </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="mt-8">
    <div class="bg-white shadow rounded-lg">
        <div class="p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Quick Actions</h3>
            <div class="mt-5 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <a href="{{ route('admin.books.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Add New Book
                </a>
                <a href="{{ route('admin.authors.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                    Add New Author
                </a>
                <a href="{{ route('admin.genres.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700">
                    Add New Genre
                </a>
                <a href="{{ route('admin.metadata.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700">
                    Add Metadata
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Add any dashboard-specific JavaScript here
</script>
@endpush