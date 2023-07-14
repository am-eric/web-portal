<?php

namespace App\Http\Controllers\Student;

use App\Models\Course;
use App\Models\Students;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $student = Students::all();
        $units = Unit::all();
        $course = Course::all();
        return view('student.courses', compact('course', 'units', 'student'));
    }

    public function mycourses()
    {
        //
        $name = Auth::user()->name;
        $admission_number = Students::where('name', $name)->value('admission_number'); // get adm.
        $enrollments = Enrollment::where('admission_number', $admission_number)->get();// pick all enrollments where adm.
        $courseIds = $enrollments->pluck('course_id'); // get courseid all the courses.
        $courses = Course::whereIn('course_id', $courseIds)->get();// get course from courses table with ref to courseid
        $units = Unit::all();
        return view('student.mycourses', compact('courses', 'units'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //get form data
        $name = $request->input('name');
        $course_id = $request->input('course_id');

        //get adm where the name matchs
        $admission_number = Students::where('name', $name)->pluck('admission_number')->first();

        // Create the enrollment record
        $enrollments = Enrollment::where('admission_number', $admission_number)->first();
        if (!$enrollments) {
            $enrollment = new Enrollment();
            $enrollment->admission_number = $admission_number;
            $enrollment->course_id = $course_id;
            $enrollment->save();

            return redirect()->back()->with('status', 'Enrollment successful.');
        }
        else
        {
            return redirect()->back()->with('status', 'Already enrolled.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
