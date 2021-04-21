<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'display_name', 'username',
        'email', 'password',
        'profile_image',
        'google_id', 'facebook_id',
        'status', 'is_admin',
        'last_login_at', 'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'is_admin_text',
        'status_text'
    ];

    public function getIsAdminTextAttribute()
    {
        $value = $this->attributes['is_admin'] ?? 0;
        $is_admin_text = 'End User';
        if ($value === 1) {
            $is_admin_text = 'Admin';
        }
        else if ($value === 2) {
            $is_admin_text = 'Super Admin';
        }
        return $this->attributes['is_admin_text'] = $is_admin_text;
    }
    public function getStatusTextAttribute()
    {
        $value = $this->attributes['status'] ?? 0;
        $status_text = 'Pending';
        if ($value === 1) {
            $status_text = 'Active';
        }
        else if ($value === 2) {
            $status_text = 'Inactive';
        }
        else if ($value === 3) {
            $status_text = 'Suspended';
        }
        return $this->attributes['status_text'] = $status_text;
    }
}
