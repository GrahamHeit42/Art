<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @method static find( $id )
 * @method static latest()
 */
class Post extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected static $logAttributes = ['*'];

    // user_type : 1 = artist, 2=Commissioner
    // artist_type : 1=personal, 2=Commissioned
    protected $fillable = [
        'user_id',
        'subject_id', 'medium_id',
        'drawn_by', 'commisioned_by',
        'title', 'description', 'keywords', 'cover_image',
        'price', 'speed', 'quality', 'communication',
        'transaction', 'concept', 'understanding', //'communication',
        'want_work_again', 'status', 'maturity_rating', 'type_id', 'professionalism'
    ];

    protected $appends = [
        'image_url',
        'status_text',
        'maturity_rating_text',
        // 'views_count'
    ];

    public function getImageUrlAttribute()
    {
        return !empty($this->attributes['cover_image']) ? asset($this->attributes['cover_image']) : null;
    }

    public function getStatusTextAttribute()
    {
        return $this->attributes['status'] === 1 ? 'Active' : 'Inactive';
    }

    public function getMaturityRatingTextAttribute()
    {
        if ($this->attributes['maturity_rating'] === 1) {
            $maturity_rating = 'General';
        } else if ($this->attributes['maturity_rating'] === 2) {
            $maturity_rating = 'Mature';
        } else {
            $maturity_rating = 'Adult';
        }

        return $maturity_rating;
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
        return $this->belongsTo(Username::class, 'drawn_by', 'id');
    }

    public function commisionedBy(): BelongsTo
    {
        return $this->belongsTo(Username::class, 'commisioned_by', 'id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class)->orderby('display_order');
    }

    public function getcomments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }


    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }
    public function views(): HasMany
    {
        return $this->hasMany(PostView::class);
    }

    // public function views_count()
    // {
    //     return $this->hasMany(PostView::class)->sum('count');
    // }

    // public function getViewsCountAttributes()
    // {
    //     dd($this->attributes->id);
    // }
}
