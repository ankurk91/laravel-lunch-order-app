<?php

namespace App\Models\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * Scope a query to ensure resource was created for given user.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param $model    Model|int
     * @param $operator string
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCreatedFor($query, $model, $operator = '=')
    {
        if ($model instanceof Model) {
            $model = $model->getKey();
        }
        return $query->where('created_for_user_id', $operator, $model);
    }
}
