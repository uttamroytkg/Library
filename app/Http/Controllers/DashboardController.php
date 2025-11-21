<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = DB::table('students') 
                -> get();
        $books = DB::table('books') 
                -> get();
        $borrows = DB::table('borrows') 
                -> get();
        $overdue_count = DB::table('borrows')
                ->where('status', 'pending')
                ->whereDate('return_date', '<', today())
                ->count();

        return view('pages.dashboard', [
            'students' => $students,
            'books' => $books,
            'borrows' => $borrows,
            'overdue_count' => $overdue_count,
        ]);
    }
}
