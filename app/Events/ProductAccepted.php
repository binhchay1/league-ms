<?php

namespace App\Events;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class ProductAccepted implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function broadcastOn()
    {
        return ['product-accepted'];
    }

    public function broadcastAs()
    {
        return 'product.accepted';
    }
}
