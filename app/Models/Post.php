<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id', 'name', 'title', 'description', 'image', 'price', 'speed', 'quality', 'professonalism', 'communication', 'transaction', 'prepertion', 'concept', 'again', 'status', 'delete_at'
    ];

    public function userDetails()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
