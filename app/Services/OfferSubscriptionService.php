<?php

namespace App\Services;

use App\Models\Offer;
use App\Models\OfferSubscription;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class OfferSubscriptionService
{
    /**
     * @return Collection
     */
    public function getAllSubscriptions(): Collection
    {
        return OfferSubscription::with('offer')->get();
    }

    /**
     * @return Collection
     */
    public function getAllOffers(): Collection
    {
        return Offer::all();
    }

    /**
     * @param int $subscriptionId
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getSubscriptionById(int $subscriptionId): Model|Collection|Builder|array|null
    {
        return OfferSubscription::query()
            ->findOrFail($subscriptionId);
    }
}
