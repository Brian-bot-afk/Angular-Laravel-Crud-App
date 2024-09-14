<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Allow mass assignment for the 'name' field
    protected $fillable = ['name'];

    // If the category is related to posts, define the relationship
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
