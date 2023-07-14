<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $table = 'units';
    protected $fillable = [
        'course_id',
        'unit_id',
        'unit_name',
        'unit_description',
        'available_slots'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

}
