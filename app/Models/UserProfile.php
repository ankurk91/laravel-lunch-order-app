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
     * @param $value
     * @return null|string
     */
    public function getFullNameAttribute($value)
    {
        if (is_null($this->first_name)) {
            return null;
        }
        return trim($this->first_name . ' ' . $this->last_name);
    }

}
