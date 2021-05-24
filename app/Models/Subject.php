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
        'image_path',
        'status'
    ];

    protected $appends = [
        'image_url',
        'status_text'
    ];

    public function getImageUrlAttribute()
    {
        return !empty($this->attributes['image_path']) ? asset($this->attributes['image_path']) : null;
    }

    public function getStatusTextAttribute()
    {
        return $this->attributes['status'] === 1 ? 'Active' : 'Inactive';
    }
}
