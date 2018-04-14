<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class OrderStatusChanged
{
    use Dispatchable, SerializesModels;

    public $oldOrder;
    public $newOrder;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Model $oldOrder, Order $newOrder)
    {
        $this->oldOrder = $oldOrder;
        $this->newOrder = $newOrder;
    }

}
