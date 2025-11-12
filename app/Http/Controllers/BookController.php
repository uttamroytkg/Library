<?php

namespace App\Http\Controllers;

use App\Models\Book;
// use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = DB::table('books') 
                -> orderBy('created_at', 'desc')
                -> get();
        return view('book.index', [
            'books' => $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'title'   => 'required|string|max:255',
            'author'  => 'required|string|max:255',
            'isbn'    => 'required|string|max:20|unique:books,isbn',
            'copies'  => 'required|integer|min:1',
            'cover'   => 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:2048',
        ]);

        // Cover upload
        $cover_path = null;
        if ($request->hasFile('cover')) {
            $cover_path = $this -> fileUpload($request->file('cover'), 'upload/book', 'book-cover');
        }
        

        // Data Store
        DB::table('books') -> insert([
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'copies' => $request->copies,
            'available_copy' => $request->copies,
            'cover' => $cover_path,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Books created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = DB::table('books') -> where('id', $id) -> first();
        
        if (!$book) {
            abort(404);
        }

        return view('book.show', [
            'book' => $book
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $book = DB::table('books') -> where('id', $id) -> first();
        
        if (!$book) {
            abort(404);
        }

        return view('book.edit', [
            'book' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'title'   => 'required|string|max:255',
            'author'  => 'required|string|max:255',
            'isbn'    => 'required|string|max:20|unique:books,isbn,' . $id,
            'copies'  => 'required|integer|min:1',
            'available_copy'  => 'required|integer|min:1',
            'cover'   => 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:2048',
        ]);

        $book = DB::table('books') -> where('id', $id) -> first();
        if (!$book) {
            abort(404);
        }

        $cover_path = $book->cover;

        // Cover Change
        if ($request->hasFile('cover')){
            if($book->cover && file_exists(public_path($book->cover))){
                @unlink(public_path($book->cover));
            }

            $cover_path = $this -> fileUpload($request->file('cover'), 'upload/book', 'book-cover');
        }

        // Data Update
        DB::table('books')
        ->where('id', $id)
        ->update([
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'copies' => $request->copies,
            'available_copy' => $request->available_copy,
            'cover' => $cover_path,
            'updated_at' => now(),
        ]);


        return back()->with('success', 'Books updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = DB::table('books') -> where('id', $id) -> first();
        
        if (!$book) {
            abort(404);
        }

        if($book->cover && file_exists(public_path($book->cover))){
            @unlink(public_path($book->cover));
        }

        // Data Delete
        DB::table('books')
        ->where('id', $id)
        ->delete();

        return back()->with('success', 'Books Deleted Successfully!');
    }
}
