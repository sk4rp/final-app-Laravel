<?php

namespace App\Events;

use App\Models\Offer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OfferCreated implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public Offer $offer;

    public function __construct($offer)
    {
        $this->offer = $offer;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('offers');
    }
}
