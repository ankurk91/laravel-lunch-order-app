<?php

namespace App\Models\Traits;

use App\Models\User;

trait CreatedByUser
{
    /**
     * This resource belong to al-least one user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function scopeCreatedBy($query, $id)
    {
        return $query->where('created_by_user_id', $id);
    }

}
