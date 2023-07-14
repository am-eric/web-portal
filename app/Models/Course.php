<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $fillable = [
        'course_id',
        'course_name',
        'course_description',
        'lecturer_id'
    ];

    // relationship btn units
    public function units()
    {
        return $this->hasMany(Unit::class, 'course_id', 'course_id');
    }

    // relationship btn enrollment
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'course_id', 'course_id');
    }

    public function teachers()
    {
        return $this->belongsTo(Teachers::class, 'lecturer_id', 'lecturer_id');
    }
    
    
}
