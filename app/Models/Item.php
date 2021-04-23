<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'path',
        'is_active', 'is_delete'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
