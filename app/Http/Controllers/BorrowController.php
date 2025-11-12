<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrows = DB::table('borrows')
            ->orderBy('return_date', 'asc')
            ->get();
        return view('borrow.index', ['borrows' => $borrows]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'return_date'  => 'required|date|after_or_equal:today',
        ]);

        DB::table('borrows')->insert([
            'student_id' => $request->student_id,
            'book_id' => $request->book_id,
            'issue_date' => now(),
            'return_date' => $request->return_date,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Book Assign Successful!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrow $borrow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Borrow $borrow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Borrow $borrow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrow $borrow)
    {
        //
    }

    /**
     * Search Students Index
     */
    public function search()
    {
        $students = DB::table('students') -> get();
        return view('borrow.search_student', [
            'students' => $students
        ]);
    }

    /**
     * Search Students
     */
    public function searchStudent(Request $request)
    {
        $students = DB::table('students') 
                    -> where('student_id', $request->search)
                    -> orWhere('email', $request->search)
                    -> orWhere('phone', $request->search)
                    -> get();

        if (!$students) {
            abort(404);
        }
                    
        return view('borrow.search_student', [
            'students' => $students
        ]);
    }

    /**
     * Search Students Get (refresh)
     */
    public function searchStudentGet()
    {
        return redirect('/borrow-search');
    }

    /**
     * Borrow Assign Book
     */
    public function borrowAssign($id)
    {
        $student = DB::table('students') -> where('id', $id) -> first();
        
        if (!$student) {
            abort(404);
        }

        $books = DB::table('books')
            -> get();

        return view('borrow.assign_book', [
            'student' => $student,
            'books' => $books,
        ]);
    }

}
