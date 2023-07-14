<?php
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Student\EnrollmentController;
use App\Http\Controllers\Student\ViewGradesController;
use App\Http\Controllers\Teacher\GradesController;
use App\Http\Controllers\Teacher\UnitController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/home', [HomeController::class, 'index'])->
    middleware('auth')->name('home');


//route for courses
Route::resource('courses', CourseController::class)
    ->middleware('auth') // Apply the built-in auth middleware for authentication
    ->middleware('role:admin') // Apply the role middleware with the specified roles
    ->names([
    'index' => 'courses.index',
    'store' => 'courses.store',
    'create' => 'courses.create',
    'show' => 'courses.show',
    'edit' => 'courses.edit',
    'update' => 'courses.update',
    'destroy' => 'courses.destroy',
]);

// routes for staff
Route::resource('staff', StaffController::class)
    ->middleware('auth') // Apply the built-in auth middleware for authentication
    ->middleware('role:admin') // Apply the role middleware with the specified roles
    ->names([
    'index' => 'staff.index',
    'store' => 'staff.store',
    'create' => 'staff.create',
    'show' => 'staff.show',
    'edit' => 'staff.edit',
    'update' => 'staff.update',
    'destroy' => 'staff.destroy',

]);

//routes for units
Route::resource('units', UnitController::class)
    ->middleware('auth') // Apply the built-in auth middleware for authentication
    ->middleware('role:teacher') // Apply the role middleware with the specified roles
    ->names([
    'index' => 'units.index',
    'store' => 'units.store',
    'create' => 'units.create',
    'show' => 'units.show',
    'edit' => 'units.edit',
    'update' => 'units.update',
    'destroy' => 'units.destroy',
]);

//routes for students
Route::resource('students', StudentController::class)
    ->middleware('auth') // Apply the built-in auth middleware for authentication
    ->middleware('role:admin') // Apply the role middleware with the specified roles
    ->names([
    'index' => 'students.index',
    'store' => 'students.store',
    'create' => 'students.create',
    'show' => 'students.show',
    'edit' => 'students.edit',
    'update' => 'students.update',
    'destroy' => 'students.destroy',
]);

//routes for enrollment
Route::resource('enrollments', EnrollmentController::class)
->middleware('auth') // Apply the built-in auth middleware for authentication
->middleware('role:student') // Apply the role middleware with the specified roles
->names([
    'index' => 'enrollments.index',
    'store' => 'enrollments.store',
    'create' => 'enrollments.create',
    'show' => 'enrollments.show',
    'edit' => 'enrollments.edit',
    'update' => 'enrollments.update',
    'destroy' => 'enrollments.destroy',
]);
Route::get('mycourses', [EnrollmentController::class, 'mycourses'])
->middleware('auth') // Apply the built-in auth middleware for authentication
->middleware('role:student') // Apply the role middleware with the specified roles
->name('enrollments.mycourses');

//routes for grades
Route::resource('grades', GradesController::class)
->middleware('auth') // Apply the built-in auth middleware for authentication
->middleware('role:teacher') // Apply the role middleware with the specified roles
->names([
    'index' => 'grades.index',
    'store' => 'grades.store',
    'create' => 'grades.create',
    'show' => 'grades.show',
    'edit' => 'grades.edit',
    'update' => 'grades.update',
    'destroy' => 'grades.destroy',
]);

//route to view grades
Route::resource('view', ViewGradesController::class)
->middleware('auth') // Apply the built-in auth middleware for authentication
->middleware('role:student') // Apply the role middleware with the specified roles
->names([
    'index' => 'view.index',
    'store' => 'view.store',
    'create' => 'view.create',
    'show' => 'view.show',
    'edit' => 'view.edit',
    'update' => 'view.update',
    'destroy' => 'view.destroy',
]);

// Route::post('enrollments/{id}', [EnrollmentController::class, 'enroll'])->name('enrollments.enroll');



require __DIR__.'/auth.php';
