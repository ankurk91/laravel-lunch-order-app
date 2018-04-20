<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'for_date' => 'date:Y-m-d',
        'quantity' => 'integer'
    ];

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function orderForUser()
    {
        return $this->belongsTo(User::class, 'created_for_user_id');
    }

    public function orderByUser()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function getTotalAttribute()
    {
        return $this->orderProducts->sum('total');
    }
}
