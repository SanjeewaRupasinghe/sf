<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
        return $this->hasMany(Course::class,'category_id');
    }
}
