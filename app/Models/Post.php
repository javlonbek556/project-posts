<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'name',
        'title',
        'image',
        
    ];
    protected $table = 'posts';
}
