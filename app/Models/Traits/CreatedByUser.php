<?php

namespace App\Models\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * Scope a query to ensure given user is the owner.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param $model Model|int
     * @param $operator string
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCreatedBy($query, $model, $operator = '=')
    {
        if ($model instanceof Model) {
            $model = $model->getKey();
        }
        return $query->where('created_by_user_id', $operator, $model);
    }


}
