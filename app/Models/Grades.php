<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grades extends Model
{
    use HasFactory;
    protected $table = 'grades';
    protected $fillable = [
        'admission_number',
        'unit_id',
        'cat1',
        'cat2',
        'marks',
        'grade',

    ];


    public function student()
    {
        return $this->belongsTo(Student::class, 'admission_number', 'admission_number');
    }

    public function units()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'unit_id');
    }



}
