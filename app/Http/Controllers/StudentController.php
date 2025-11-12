<?php

namespace App\Http\Controllers;

use App\Models\Student;
// use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = DB::table('students') 
                    -> orderBy('created_at', 'desc')
                    -> get();
        return view('student.index', [
            'students' => $students
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'phone'     => 'required|regex:/^01[3-9][0-9]{8}$/|unique:students,phone',
            'student_id'  => 'required|string|max:10|unique:students,student_id',
            'address'   => 'required|string|max:255',
            'photo'   => 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:2048',
        ]);

        // Photo upload
        $profile_path = null;
        if ($request->hasFile('photo')) {
            // $image = $request->file('photo');
            // $imageName = 'student-photo' . time() . rand(99, 999) . '.' . $image->getClientOriginalExtension();
            // $image->move(public_path('upload/user'), $imageName);
            // $profile_path = 'upload/user/' . $imageName;
            $profile_path = $this -> fileUpload($request->file('photo'), 'upload/user', 'student-profile');
        }

        // Data Store
        DB::table('students') -> insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'student_id' => $request->student_id,
            'address' => $request->address,
            'photo' => $profile_path,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Student created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = DB::table('students') -> where('id', $id) -> first();
        
        if (!$student) {
            abort(404);
        }

        return view('student.show', [
            'student' => $student
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = DB::table('students') -> where('id', $id) -> first();
        
        if (!$student) {
            abort(404);
        }

        return view('student.edit', [
            'student' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'phone'     => 'required|regex:/^01[3-9][0-9]{8}$/|unique:students,phone,' . $id,
            'student_id'  => 'required|string|max:10|unique:students,student_id,' . $id,
            'address'   => 'required|string|max:255',
            'photo'   => 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:2048',
        ]);

        $student = DB::table('students') -> where('id', $id) -> first();
        if (!$student) {
            abort(404);
        }

        $profile_path = $student->photo;

        // Cover Change
        if ($request->hasFile('photo')){
            if($student->photo && file_exists(public_path($student->photo))){
                @unlink(public_path($student->photo));
            }

            $profile_path = $this -> fileUpload($request->file('photo'), 'upload/user', 'student-profile');
        }

        // Data Update
        DB::table('students')
        ->where('id', $id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'student_id' => $request->student_id,
            'address' => $request->address,
            'photo' => $profile_path,
            'updated_at' => now(),
        ]);


        return back()->with('success', 'Student updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = DB::table('students') -> where('id', $id) -> first();
        
        if (!$student) {
            abort(404);
        }

        if($student->photo && file_exists(public_path($student->photo))){
            @unlink(public_path($student->photo));
        }

        // Data Delete
        DB::table('students')
        ->where('id', $id)
        ->delete();

        return back()->with('success', 'Student Deleted Successfully!');
    }
}
