<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::withCount('books')
            ->orderBy('name')
            ->paginate(10);
            
        return view('admin.authors.index', compact('authors'));
    }

    public function create()
    {
        return view('admin.authors.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->store('authors/images', 'public');
            
            $validated['image'] = $imageName;
            $validated['image_path'] = Storage::url($imagePath);
        }

        $author = Author::create($validated);

        return redirect()
            ->route('admin.authors.index')
            ->with('success', 'Author created successfully.');
    }
    public function edit(Author $author)
    {
        return view('admin.authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'bio' => 'nullable',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($author->image_path) {
                Storage::disk('public')->delete($author->image_path);
            }
            $path = $request->file('image')->store('authors/images', 'public');
            $author->image = $request->file('image')->getClientOriginalName();
            $author->image_path = $path;
        }

        $author->name = $validated['name'];
        $author->bio = $validated['bio'];
        $author->save();

        return redirect()->route('admin.authors.index')
            ->with('success', 'Author updated successfully.');
    }

    public function destroy(Author $author)
    {
        if ($author->image_path) {
            Storage::disk('public')->delete($author->image_path);
        }
        
        $author->delete();

        return redirect()->route('admin.authors.index')
            ->with('success', 'Author deleted successfully.');
    }
}