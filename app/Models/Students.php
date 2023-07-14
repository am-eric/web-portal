<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'admission_number',
        'name'
    ];
    
    // relationship btn enrollments
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'admission_number', 'admission_number');
    }
}
