<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use Traits\BelongsToUser;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'primary_phone', 'avatar', 'user_id',
    ];

    /**
     * Get the full name
     *
     * @param  string $value
     * @return string
     */
    public function getFullNameAttribute($value)
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

}
