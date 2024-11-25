<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use App\Models\MetaData;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'genre', 'tracking', 'metaData'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::all();
        $genres = Genre::all();
        return view('admin.books.create', compact('authors', 'genres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'author_id' => 'required|exists:authors,id',
            'genre_id' => 'required|exists:genres,id',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
            'book_file' => 'nullable|mimes:pdf,epub|max:10240',
            'meta_title' => 'required|max:255',
            'meta_description' => 'required'
        ]);

        $book = new Book();
        $book->fill($validated);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('books/images', 'public');
            $book->image = $request->file('image')->getClientOriginalName();
            $book->image_path = $path;
        }

        if ($request->hasFile('book_file')) {
            $path = $request->file('book_file')->store('books/files', 'public');
            $book->book_path = $path;
        }

        $book->save();

        // Create meta data
        MetaData::create([
            'book_id' => $book->id,
            'author_id' => $validated['author_id'],
            'meta_title' => $validated['meta_title'],
            'meta_description' => $validated['meta_description']
        ]);

        // Initialize tracking
        Tracking::create([
            'book_id' => $book->id
        ]);

        return redirect()->route('admin.books.index')
            ->with('success', 'Book created successfully.');
    }

    public function edit(Book $book)
    {
        $authors = Author::all();
        $genres = Genre::all();
        return view('admin.books.edit', compact('book', 'authors', 'genres'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'author_id' => 'required|exists:authors,id',
            'genre_id' => 'required|exists:genres,id',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
            'book_file' => 'nullable|mimes:pdf,epub|max:10240',
            'meta_title' => 'required|max:255',
            'meta_description' => 'required'
        ]);

        if ($request->hasFile('image')) {
            if ($book->image_path) {
                Storage::disk('public')->delete($book->image_path);
            }
            $path = $request->file('image')->store('books/images', 'public');
            $book->image = $request->file('image')->getClientOriginalName();
            $book->image_path = $path;
        }

        if ($request->hasFile('book_file')) {
            if ($book->book_path) {
                Storage::disk('public')->delete($book->book_path);
            }
            $path = $request->file('book_file')->store('books/files', 'public');
            $book->book_path = $path;
        }

        $book->update($validated);

        $book->metaData->update([
            'meta_title' => $validated['meta_title'],
            'meta_description' => $validated['meta_description']
        ]);

        return redirect()->route('admin.books.index')
            ->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        if ($book->image_path) {
            Storage::disk('public')->delete($book->image_path);
        }
        if ($book->book_path) {
            Storage::disk('public')->delete($book->book_path);
        }
        
        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Book deleted successfully.');
    }
}