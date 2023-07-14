<?php

namespace App\Http\Controllers\Admin;

use App\Models\Staff;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $staff = Staff::all();
        return view('admin.staff', compact('staff'));
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
        // validate the form data
        $validatedData = $request->validate([
            'staff_id' => 'required|unique:staff,staff_id|string',
            'name' => 'required|string',
            'email' => 'required|email|unique:staff',
            'password' => 'required|min:8',
            'role' => 'required|string',
            'phone' => 'required|string',
            'department' => 'required|string'
        ]);
        // create a new instance of staff model
        $staff = new Staff();
        $staff->staff_id = $validatedData['staff_id'];
        $staff->name = $validatedData['name'];
        $staff->email = $validatedData['email'];
        $staff->password = bcrypt($validatedData['password']);
        $staff->role = $validatedData['role'];
        $staff->phone = $validatedData['phone'];
        $staff->department = $validatedData['department'];

        // save to db
        $staff->save();

        // redirect the user
        return redirect()->back()->with('status', 'Staff added successfully!');
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
    public function update(Request $request, $staff_id)
    {
        $staffMember = Staff::where('staff_id', $staff_id)->first();
        //dd($staff_id);
        if ($staffMember) {
            $staffMember->staff_id = $request->input('staff_id');
            $staffMember->name = $request->input('name');
            $staffMember->email = $request->input('email');
            $staffMember->password = bcrypt($request->input('password'));
            $staffMember->role = $request->input('role');
            $staffMember->phone = $request->input('phone');
            $staffMember->department = $request->input('department');

            // update in db
            $staffMember->update();

            return redirect()->back()->with('status', 'Staff updated successfully');
        }

        // Handle the case when the staff member is not found
        return redirect()->back()->with('status', 'Staff member not found');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($staff_id)
    {
        //
        $staff = Staff::where('staff_id', $staff_id)->first();
        $staff->delete();
        return redirect()->back()->with('status', 'Staff deleted successfully!');
    }
}
