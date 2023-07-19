<?php

namespace App\Models;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
