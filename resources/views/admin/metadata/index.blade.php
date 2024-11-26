@extends('admin.layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="flex justify-between items-center px-6 py-4 bg-gray-100 border-b">
        <h1 class="text-2xl font-bold text-gray-800">Metadata Management</h1>
        <a href="{{ route('admin.metadata.create') }}" class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
            <i class="ri-add-line mr-2"></i>
            Create New Metadata
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- Search and Filter --}}
    <div class="px-6 py-4 bg-gray-50">
        <form action="{{ route('admin.metadata.index') }}" method="GET" class="flex space-x-4">
            <input 
                type="text" 
                name="search" 
                placeholder="Search by title or description" 
                value="{{ request('search') }}" 
                class="flex-grow px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <select name="book" class="px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">All Books</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
            </select>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
                Search
            </button>
        </form>
    </div>

    {{-- Metadata Table --}}
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meta Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($metaData as $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->book->title ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->author->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ Str::limit($item->meta_title, 50) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.metadata.show', $item) }}" class="text-blue-600 hover:text-blue-900">
                                    <i class="ri-eye-line"></i>
                                </a>
                                <a href="{{ route('admin.metadata.edit', $item) }}" class="text-green-600 hover:text-green-900">
                                    <i class="ri-edit-line"></i>
                                </a>
                                <form action="{{ route('admin.metadata.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this metadata?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            No metadata found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection