<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Enrollment;
use App\Models\Teachers;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;

            if ($usertype == 'student') {
                return view('student.studenthome');
            } else if ($usertype == 'teacher') {
                $name = Auth::user()->name;
                $enrollments = Enrollment::all();
                $lecturer_id = Teachers::where('name', $name)->value('lecturer_id');
                $course = Course::where('lecturer_id', $lecturer_id)->with('units')->get(); // search for course linked with the lecturer id and get units
                return view('teacher.teacherhome', compact('course', 'enrollments'));
            } else if ($usertype == 'admin') {
                return view('admin.adminhome');
            } else {
                return redirect()->back();
            }
        }
    }
}
