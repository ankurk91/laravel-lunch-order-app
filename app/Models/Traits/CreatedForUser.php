<?php

namespace App\Models\Traits;

use App\Models\User;

trait CreatedForUser
{

    public function createdForUser()
    {
        return $this->belongsTo(User::class, 'created_for_user_id');
    }

    public function scopeCreatedFor($query, $id)
    {
        return $query->where('created_for_user_id', $id);
    }

}
