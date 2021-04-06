<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id', 'name', 'title', 'description', 'image', 'price', 'speed', 'quality', 'professonalism', 'communication', 'transaction', 'prepertion', 'again', 'status', 'delete_at'
    ];
}
