<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Subject;
use App\Models\Medium;

class Post extends Model
{
    use HasFactory;

    // user_type : 1=artist, 2=Commissioner
    // artist_type : 1=personal, 2=Commissioned
    protected $fillable = [
        'user_id',
        'user_type', 'artist_type',
        'drawn_by', 'commisioned_by',
        'subject_id', 'medium_id',
        'title', 'description', 'keywords',
        'c_price', 'c_speed', 'c_quality', 'c_communication', 'c_work_again',
        'a_transaction', 'a_concept', 'a_understanding', 'a_communication', 'a_work_again',
        'status', 'delete_at'
    ];

    public function userDetails()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function drawnBy()
    {
        return $this->belongsTo(User::class, 'drawn_by', 'id');
    }

    public function commisionedBy()
    {
        return $this->belongsTo(User::class, 'commisioned_by', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function medium()
    {
        return $this->belongsTo(Medium::class, 'medium_id', 'id');
    }
}
