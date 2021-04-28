<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static whereStatus( int $int )
 */
class Medium extends Model
{
    use HasFactory;

    protected $table = 'mediums';

    protected $fillable = [
        'type', 'is_active'
    ];
}
