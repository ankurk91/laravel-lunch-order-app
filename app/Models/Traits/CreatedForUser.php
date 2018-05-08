<?php

namespace App\Models\Traits;

use App\Models\User;

trait CreatedForUser
{

    /**
     * This resource belong to al-least one user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdForUser()
    {
        return $this->belongsTo(User::class, 'created_for_user_id');
    }

    public function scopeCreatedFor($query, $id)
    {
        return $query->where('created_for_user_id', $id);
    }

}
