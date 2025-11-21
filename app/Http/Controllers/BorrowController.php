<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrows = DB::table('borrows')
            ->where('status', 'pending')
            ->join('students', 'borrows.student_id', '=', 'students.id')
            ->join('books', 'borrows.book_id', '=', 'books.id')
            ->select('borrows.*', 'students.name', 'students.photo', 'books.title', 'books.cover', 'students.created_at as student_created')
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

        DB::table('books')
            ->where('id', $request->book_id)
            ->decrement('available_copy', 1);

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
    public function edit($id)
    {
        $borrow = DB::table('borrows')
                ->join('books', 'borrows.book_id', '=', 'books.id')
                ->where('borrows.id', $id)   
                ->select('borrows.*', 'books.id as selected_book_id', 'books.cover as book_cover')
                ->first();

        if (!$borrow) {
            abort(404);
        }

        $books = DB::table('books')
            ->where('available_copy', '>', 0)
            -> get();

        return view('borrow.edit', [
            'borrow' => $borrow,
            'books' => $books,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'return_date'  => 'required|date|after_or_equal:today',
        ]);

        $borrow = DB::table('borrows')->where('id', $id)->first();

        if(!$borrow){
            return back()->with('error', 'Borrow record not found');
        }

        if(Carbon::parse($request->return_date)->lt($borrow->issue_date)){
            return back()->with('error', 'Return date must be greater then Issue date');
        }

        if($request->book_id != $request->old_book){
            DB::table('books')
                ->where('id', $request->book_id)
                ->decrement('available_copy', 1);

            DB::table('books')
                ->where('id', $request->old_book)
                ->increment('available_copy', 1);
        }

        DB::table('borrows')
            ->where('id', $id)
            ->update([
                'return_date' => $request->return_date,
                'book_id' => $request->book_id,
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Borrow Update Successful!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $borrow = DB::table('borrows')->where('id', $id)->where('status', 'returned')->first();

        if(!$borrow){
            abort(404);
        }

        DB::table('borrows')
            ->where('id', $id)
            ->delete();

        return back()->with('success', 'Borrow Deleted Successfully!');
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
            ->where('available_copy', '>', 0)
            -> get();

        return view('borrow.assign_book', [
            'student' => $student,
            'books' => $books,
        ]);
    }

    /**
     * Borrow Return
     */
    public function borrowReturn($id){
    
        $borrow = DB::table('borrows')->where('id', $id)->first();

        if(!$borrow){
            abort(404);
        }

        DB::table('borrows')
            ->where('id', $id)
            ->update([
                'status' => 'returned',
                'updated_at' => now(),
            ]);

        // Increase book copy
        DB::table('books')
            ->where('id', $borrow->book_id)
            ->increment('available_copy', 1);

        return back()->with('success', 'Book returned');
    }

    /**
     * Borrow Pending
     */
    public function borrowPending($id){
        $borrow = DB::table('borrows')->where('id', $id)->first();

        if(!$borrow){
            abort(404);
        }

        DB::table('borrows')
            ->where('id', $id)
            ->update([
                'status' => 'pending',
                'updated_at' => now(),
            ]);

        // decrement book copy
        DB::table('books')
            ->where('id', $borrow->book_id)
            ->decrement('available_copy', 1);

        return back()->with('success', 'Book pending');
    }

    /**
     * Display a listing of returned borrows.
     */
    public function returnedBorrows()
    {
        $borrows = DB::table('borrows')
            ->where('status', 'returned')
            ->join('students', 'borrows.student_id', '=', 'students.id')
            ->join('books', 'borrows.book_id', '=', 'books.id')
            ->select('borrows.*', 'students.name', 'students.photo', 'books.title', 'books.cover', 'students.created_at as student_created')
            ->orderBy('return_date', 'asc')
            ->get();

        return view('borrow.returned', ['borrows' => $borrows]);
    }

}
