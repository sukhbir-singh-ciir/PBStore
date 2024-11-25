<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Tracking;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalBooks' => Book::count(),
            'totalAuthors' => Author::count(),
            'totalGenres' => Genre::count(),
            'totalDownloads' => 0,
            'recentBooks' => Book::with('author')
                ->latest()
                ->take(5)
                ->get(),
            'recentAuthors' => Author::withCount('books')
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
}
