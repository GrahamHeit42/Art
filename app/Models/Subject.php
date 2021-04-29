<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static whereStatus( int $int )
 */
class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status'
    ];

    protected $appends = [
        'status_text'
    ];

    public function getStatusTextAttribute()
    {
        return $this->attributes['status'] === 1 ? 'Active' : 'Inactive';
    }
}
