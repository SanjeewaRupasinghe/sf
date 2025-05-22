<?php

namespace App\Models;

use App\Models\ApBlogPost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApBlogCategory extends Model
{
    use HasFactory;
    public function count()
    {
        return $this->hasMany(ApBlogPost::class);
    }
}
