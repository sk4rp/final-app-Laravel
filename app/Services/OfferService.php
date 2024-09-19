<?php

namespace App\Services;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferService
{
    public function getUserOffers(int $userId): Collection|array
    {
        return Offer::query()->where('advertiser_id', $userId)->get();
    }

    public function getOffers(): Collection|array
    {
        return Offer::query()->get();
    }

    public function getOfferById(int $offerId): Builder
    {
        return Offer::query()->where('id', $offerId);
    }

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

        return Offer::query()
            ->create($validated);
    }

    public function activateOffer(int $offerId): void
    {
        Offer::query()
            ->where('id', $offerId)
            ->update(['is_active' => true]);
    }

    public function deactivateOffer(int $offerId): void
    {
        Offer::query()
            ->where('id', $offerId)
            ->update(['is_active' => false]);
    }

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

    public function deleteOffer(Offer $offer): void
    {
        $offer->expenses()->delete();
        $offer->clicks()->delete();
        $offer->subscriptions()->delete();
        $offer->delete();
    }

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
