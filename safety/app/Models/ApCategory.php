<?php

namespace App\Models;

use App\Models\ApCourse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApCategory extends Model
{
    use HasFactory;
    public function children()
    {
        return $this->hasMany(self::class,'parent_id','id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function courses()
    {
        return $this->hasMany(ApCourse::class,'category_id');
    }
}
