<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Students;
use App\Models\User;
use App\Helper\Helper;
use App\Models\Teachers;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'usertype' => ['required', 'in:student,admin,teacher'], // Ensure it's an array
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => $request->usertype, // Save the selected usertype
        ]);



        event(new Registered($user));
        
        // create admission number using helper
        $admissionNumber = Helper::NumberIDGenerator('students', [], 'ADM-', 6);

        // populate the students table in the db
        if ($request->usertype === 'student') { // Check if the user is registering as a student
            // Create admission number using the Helper class
            $admissionNumber = Helper::NumberIDGenerator('students', [], 'ADM-', 6);

            // Populate the students table in the database
            Students::create([
                'admission_number' => $admissionNumber,
                'name' => $user->name,
            ]);
        }
        elseif ($request->usertype === 'teacher') {
            // Create admission number using the Helper class
            $lecturer_id = Helper::NumberIDGenerator('teachers', [], 'KU-', 6);

            // Populate the students table in the database
            Teachers::create([
                'lecturer_id' => $lecturer_id,
                'name' => $user->name,
            ]);
        }

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
