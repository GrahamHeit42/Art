<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Username extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'username',
        'created_by',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }*/
}
