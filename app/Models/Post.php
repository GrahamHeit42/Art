<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static find( $id )
 * @method static latest()
 */
class Post extends Model
{
    use HasFactory, SoftDeletes;

    // user_type : 1 = artist, 2=Commissioner
    // artist_type : 1=personal, 2=Commissioned
    protected $fillable = [
        'user_id',
        'subject_id', 'medium_id',
        'drawn_by', 'commisioned_by',
        'title', 'description', 'keywords', 'cover_image',
        'price', 'speed', 'quality', 'communication',
        'transaction', 'concept', 'understanding', //'communication',
        'want_work_again', 'status', 'maturity_rating'
    ];

    protected $appends = [
        'image_url',
        'status_text'
    ];

    public function getImageUrlAttribute()
    {
        return !empty($this->attributes['cover_image']) ? asset($this->attributes['cover_image']) : null;
    }

    public function getStatusTextAttribute()
    {
        return $this->attributes['status'] === 1 ? 'Active' : 'Inactive';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function medium(): BelongsTo
    {
        return $this->belongsTo(Medium::class);
    }

    public function drawnBy(): BelongsTo
    {
        return $this->belongsTo(Username::class, 'id', 'drawn_by');
    }

    public function commisionedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'commisioned_by', 'id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
}
