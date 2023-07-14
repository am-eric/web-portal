<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Course;
use App\Models\Unit;
use App\Models\Teachers;
use App\Models\Students;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Grades;
use Illuminate\Http\Request;

class GradesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = Auth::user()->name;
        $enrollments = Enrollment::all();
        $lecturer_id = Teachers::where('name', $name)->value('lecturer_id');
        $course = Course::where('lecturer_id', $lecturer_id)->with('units')->get(); // search for course linked with the lecturer id and get units 
        
        //get grades
        $grades = Grades::all();
        return view('teacher.grades', compact('course', 'enrollments', 'grades'));
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
        //get id from unit table since id is used as FK reference 
        $unit_id = $request->input('unit_id');
        $id = Unit::where('unit_id', $unit_id)->get()->pluck('id')->first();

        $admission_number = $request->input('admission_number');
        $unit_id = $id;
        $cat1 = $request->input('cat1');
        $cat2 = $request->input('cat2');
        $exam = $request->input('exam');

        // Calculate total marks and grade
        $marks = ($cat1 + $cat2) * 0.3 + $exam;

        $grade = '';

        if ($marks >= 70) {
            $grade = 'A';
        } elseif ($marks >= 60) {
            $grade = 'B';
        } elseif ($marks >= 50) {
            $grade = 'C';
        } elseif ($marks >= 40) {
            $grade = 'D';
        } else {
            $grade = 'F';
        }

        $student = Students::where('admission_number', $admission_number)->first();

        if ($student) {
            // Save the performance marks for the student
            $performance = new Grades();
            $performance->admission_number = $admission_number;
            $performance->unit_id = $unit_id;
            $performance->cat1 = $cat1;
            $performance->cat2 = $cat2;
            $performance->exam = $exam;
            $performance->marks = $marks;
            $performance->grade = $grade;
            $performance->save();

            return redirect()->back()->with('status', 'Unit added successfully!');
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
