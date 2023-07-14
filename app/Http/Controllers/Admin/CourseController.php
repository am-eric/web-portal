<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Teachers;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course = Course::all();
        $teachers = Teachers::all();
        return view('admin.index', compact('course', 'teachers'));
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
        //store to database

        // Create a new instance of the Course model
        $validatedData = $request->validate([
            'course_id' => 'required|unique:courses,course_id|string',
            'course_name' => 'required|string',
            'course_description' => 'required|string',
            'name' => 'required|string', 
        ]);

        // // Check if the course already exists
        // $existingCourse = Course::where('course_id', $validatedData['course_id'])->first();
        // if ($existingCourse) {
        //     // Course already exists, handle the error
        //     return redirect('courses')->with('error', 'Course already exists!');
        // }
        $name = $request->input('name');
        $lecturer_id = Teachers::where('name', $name)->pluck('lecturer_id')->first();
    
        $course = new Course();
        $course->course_id = $validatedData['course_id'];
        $course->course_name = $validatedData['course_name'];
        $course->course_description = $validatedData['course_description'];
        $course->lecturer_id = $lecturer_id;
        

        // Save the course to the database
        $course->save();

        // Redirect the user or perform any other actions as needed
        return redirect()->back()->with('status', 'Course added successfully!');


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
        // $course = Course::find($id);
        
        // $name = $request->input('name');
        // dd($name);
        // $lecturer_id = Teachers::where('name', $name)->pluck('lecturer_id')->first();

        // $course->course_id = $request->input('course_id');
        // $course->course_name = $request->input('course_name');
        // $course->course_description = $request->input('course_description');
        // $course->lecturer_id = $lecturer_id;
        // $course->update();
        // return redirect()->back()->with('status', 'Course updated successfully!');

        $course = Course::find($id);
        $validatedData = $request->validate([
            'course_id' => 'required|string',
            'course_name' => 'required|string',
            'course_description' => 'required|string',
            'name' => 'required|string',
        ]);

        $name = $request->input('name');
        $lecturer_id = Teachers::where('name', $name)->pluck('lecturer_id')->first();

        $course->course_id = $validatedData['course_id'];
        $course->course_name = $validatedData['course_name'];
        $course->course_description = $validatedData['course_description'];
        $course->lecturer_id = $lecturer_id;

        $course->update();

        return redirect()->back()->with('status', 'Course updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        
        $course->delete();
        return redirect()->back()->with('status', 'Course deleted successfully!');
        
    }
}
