<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Expression;
use N7olkachev\ComputedProperties\ComputedProperties;

class Order extends Model
{
    use SoftDeletes, ComputedProperties, Traits\CreatedForUser, Traits\CreatedByUser;

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

    public function computedTotal($order)
    {
        return OrderProduct::select(new Expression('sum(unit_price * quantity)'))
            ->where('order_id', $order->id);
    }

}
