<?php

namespace App\Models;

use App\Models\ApBlogCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApBlogPost extends Model
{
    use HasFactory;
    public function apBlogCategory()
    {
        return $this->belongsTo(ApBlogCategory::class);
    }
}
