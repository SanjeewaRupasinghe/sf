<?php

namespace App\Models;

use App\Models\ApCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApCourse extends Model
{
    use HasFactory;
    public function ApCategory()
    {
        return $this->belongsTo(ApCategory::class);
    }
}
