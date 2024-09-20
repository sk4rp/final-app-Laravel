<?php

namespace App\Services;

use App\Events\OfferCreated;
use App\Models\Offer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferService
{
    /**
     * @param int $userId
     * @return Collection|array
     */
    public function getUserOffers(int $userId): Collection|array
    {
        return Offer::query()
            ->where('advertiser_id', $userId)
            ->get();
    }

    /**
     * @return Collection|array
     */
    public function getOffers(): Collection|array
    {
        return Offer::query()
            ->get();
    }

    /**
     * @param Request $request
     * @return Model|Builder
     */
    public function createOffer(Request $request): Model|Builder
    {
        $this->validateOffer($request);

        $validated = $request->only([
            'name',
            'cost_per_click',
            'target_url',
            'site_themes',
        ]);

        $validated['advertiser_id'] = Auth::id();
        $offer = Offer::query()->create($validated);

        event(new OfferCreated($offer));

        return $offer;
    }

    /**
     * @param int $offerId
     * @return void
     */
    public function activateOffer(int $offerId): void
    {
        Offer::query()
            ->where('id', $offerId)
            ->update(['is_active' => true]);
    }

    /**
     * @param int $offerId
     * @return void
     */
    public function deactivateOffer(int $offerId): void
    {
        Offer::query()
            ->where('id', $offerId)
            ->update(['is_active' => false]);
    }

    /**
     * @param Request $request
     * @param Offer $offer
     * @return Offer
     */
    public function updateOffer(Request $request, Offer $offer): Offer
    {
        $this->validateOffer($request);

        $offer->update($request->only([
            'name',
            'cost_per_click',
            'target_url',
            'site_themes',
        ]));

        return $offer;
    }

    /**
     * @param Offer $offer
     * @return void
     */
    public function deleteOffer(Offer $offer): void
    {
        $offer->clicks()->delete();
        $offer->subscriptions()->delete();
        $offer->delete();
    }

    /**
     * @param Request $request
     * @return void
     */
    private function validateOffer(Request $request): void
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cost_per_click' => 'required',
            'target_url' => 'required|url',
            'site_themes' => 'required|string',
        ]);
    }
}
