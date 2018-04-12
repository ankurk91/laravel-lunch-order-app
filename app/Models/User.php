<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'blocked_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'blocked_at',
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    /**
     * User may have `null` password when sign-up via socialite
     *
     * @return bool
     */
    public function getHasNullPasswordAttribute()
    {
        return is_null($this->password);
    }

    /**
     * Get the user's account blocked status
     *
     * @param  string $value
     * @return bool
     */
    public function getIsBlockedAttribute($value)
    {
        return !is_null($this->blocked_at);
    }

    /**
     * Scope a query to only active users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('blocked_at', null);
    }

    /**
     * Scope a query to only blocked users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBlocked($query)
    {
        return $query->where('blocked_at', '!=', null);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'created_for');
    }
}
