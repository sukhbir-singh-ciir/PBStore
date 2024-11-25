<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
class GenreController extends Controller
{
    public function index()
    {
        try {
            $genres = Genre::withCount('books')
                ->orderBy('genre')
                ->paginate(10);

            return view('admin.genres.index', compact('genres'));
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error loading genres. Please try again.');
        }
    }

    /**
     * Store a newly created genre
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'genre' => 'required|string|max:255|unique:genres,genre'
            ]);

            DB::beginTransaction();
            
            Genre::create($validated);
            
            DB::commit();

            return redirect()
                ->route('admin.genres.index')
                ->with('success', 'Genre created successfully.');

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Database error occurred while creating genre.')
                ->withInput();

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'An error occurred while creating genre.')
                ->withInput();
        }
    }

    /**
     * Update the specified genre
     *
     * @param Request $request
     * @param Genre $genre
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Genre $genre)
    {
        try {
            $validated = $request->validate([
                'genre' => 'required|string|max:255|unique:genres,genre,' . $genre->id
            ]);

            DB::beginTransaction();
            
            $genre->update($validated);
            
            DB::commit();

            return redirect()
                ->route('admin.genres.index')
                ->with('success', 'Genre updated successfully.');

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Database error occurred while updating genre.')
                ->withInput();

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'An error occurred while updating genre.')
                ->withInput();
        }
    }

    /**
     * Remove the specified genre
     *
     * @param Genre $genre
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Genre $genre)
    {
        try {
            DB::beginTransaction();

            // Check if genre has associated books
            if ($genre->books()->exists()) {
                throw new \Exception('Cannot delete genre with associated books.');
            }

            $genre->delete();
            
            DB::commit();

            return redirect()
                ->route('admin.genres.index')
                ->with('success', 'Genre deleted successfully.');

        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Database error occurred while deleting genre.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Get all genres for API/Ajax requests
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGenres()
    {
        try {
            $genres = Genre::select('id', 'genre')
                ->orderBy('genre')
                ->get();

            return response()->json([
                'status' => 'success',
                'data' => $genres
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error fetching genres'
            ], 500);
        }
    }
}