<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MetaData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MetaDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metaData = MetaData::with(['book', 'author'])->paginate(10);
        $books = \App\Models\Book::all();
        return view('admin.metadata.index', compact('metaData','books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = \App\Models\Book::all();
        $authors = \App\Models\Author::all();
        
        return view('admin.metadata.create', compact('books', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'author_id' => 'required|exists:authors,id',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'nullable|string|max:500'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $metaData = MetaData::create($validator->validated());

        return redirect()->route('admin.metadata.index')
            ->with('success', 'Metadata created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MetaData $metaData)
    {
        return view('admin.metadata.show', compact('metaData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MetaData $metaData)
    {
        $books = \App\Models\Book::all();
        $authors = \App\Models\Author::all();
        
        return view('admin.metadata.edit', compact('metaData', 'books', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MetaData $metaData)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'author_id' => 'required|exists:authors,id',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'nullable|string|max:500'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $metaData->update($validator->validated());

        return redirect()->route('admin.metadata.index')
            ->with('success', 'Metadata updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MetaData $metaData)
    {
        $metaData->delete();

        return redirect()->route('admin.metadata.index')
            ->with('success', 'Metadata deleted successfully.');
    }
}