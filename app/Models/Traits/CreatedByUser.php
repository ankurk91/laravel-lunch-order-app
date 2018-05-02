<?php

namespace App\Models\Traits;

use App\Models\User;

trait CreatedByUser
{

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function scopeCreatedBy($query, $id)
    {
        return $query->where('created_by_user_id', $id);
    }

}
