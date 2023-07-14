<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    use HasFactory;

    protected $fillable = [
        'lecturer_id',
        'name'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class, 'lecturer_id', 'lecturer_id');
    }
    
}
