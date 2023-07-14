<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Course;
use App\Models\Unit;
use App\Models\Teachers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**retrieve the user name from users table.
        * then parse the teachers table to search for 
        * name and retrieve the lecturer id */
        
        $name = Auth::user()->name;
        $lecturer_id = Teachers::where('name', $name)->value('lecturer_id');
        $course = Course::where('lecturer_id', $lecturer_id)->with('units')->get(); // search for course linked with the lecturer id and get units 
        return view('teacher.units', compact('course'));
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
        // Validate the request data
        $validatedData = $request->validate([
            'course_id' => 'required|string',
            'unit_id' => 'required|unique:units,unit_id|string',
            'unit_name' => 'required|string',
            'unit_description' => 'required|string',
            'available_slots' => 'required|string'
        ]);

        try {
            // Retrieve the course from the database based on the course_id
            $course = Course::where('course_id', $validatedData['course_id'])->first();

            if (!$course) {
                // If the course does not exist, you can return an error response or redirect back with an error message
                return redirect()->back()->withErrors('Invalid course selected!');
            }

            // Create a new Unit instance
            $unit = new Unit();
            $unit->course_id = $course->course_id; // Assign the actual course ID instead of the course_id value from the request
            $unit->unit_id = $validatedData['unit_id'];
            $unit->unit_name = $validatedData['unit_name'];
            $unit->unit_description = $validatedData['unit_description'];
            $unit->available_slots = $validatedData['available_slots'];

            // Save the unit to the database
            $unit->save();

            // Redirect the user or perform any other actions as needed
            return redirect()->back()->with('status', 'Unit added successfully!');
        } catch (\Exception $e) {
            // Display the error message for debugging
            dd($e->getMessage());
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

        // get courses and courses_id
        $course = Course::where('course_id', $request->input('course_id'))->first();

        //     //
        //    // dd($unit_id);
        //     $unit = Unit::where('unit_id',$unit_id)->get();
        //     if($unit){
        //         $units=Unit::updateorCreate([
        //             'id'=>$request->id,
        //             'course_id'=>$request->course_id,
        //             'unit_id'=>$request->unit_id,
        //             'unit_name'=>$request->unit_name,
        //             'unit_description'=>$request->unit_description,
        //         ]);

        //     }

        // dd($request->course_id);

        $unit = Unit::find($id);
        $unit->course_id = $course->course_id;
        $unit->unit_id = $request->input('unit_id');
        $unit->unit_name = $request->input('unit_name');
        $unit->unit_description = $request->input('unit_description');

        $unit->update();

        

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
        //delete unit 
        $unit = Unit::find($id);// we find the id. used as primary key now for the table. 
        $unit->delete();
        return redirect()->back()->with('status', 'Course deleted successfully!');
    }
}
