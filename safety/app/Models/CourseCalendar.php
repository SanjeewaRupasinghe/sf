<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseCalendar extends Model
{
    use HasFactory;

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
