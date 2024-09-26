<?php

namespace App\Services;

use App\Exceptions\OfferException;
use App\Http\Requests\OfferRequest;
use App\Models\Click;
use App\Models\Offer;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class OfferService
{
    /**
     * @param int $userId
     * @return Collection
     */
    public function getUserOffers(int $userId): Collection
    {
        return Offer::query()
            ->where('advertiser_id', $userId)
            ->get();
    }

    /**
     * @param int $offerId
     * @return Model|Collection|Builder|array
     * @throws OfferException
     */
    public function findOfferByIt(int $offerId): Model|Collection|Builder|array
    {
        $offer = Offer::query()->find($offerId);

        if (!$offer) {
            throw new OfferException('Offer not found');
        }

        return $offer;
    }

    /**
     * @return Collection
     */
    public function getOffers(): Collection
    {
        return Offer::query()
            ->get();
    }

    /**
     * @return int
     */
    public function getOffersCount(): int
    {
        return Offer::query()->count();
    }

    /**
     * @return int
     */
    public function getTargetUrlCountFromOffers(): int
    {
        return Offer::query()
            ->distinct('target_url')
            ->count('target_url');
    }

    /**
     * @param OfferRequest $request
     * @return RedirectResponse|void
     */
    public function createOffer(OfferRequest $request)
    {
        $validated = $request->validated();

        $advertiser = auth()->user();
        $validated['advertiser_id'] = $advertiser->getAuthIdentifier();
        $minTrafficCost = 100.00;

        if ($advertiser->balance < $minTrafficCost) {
            return redirect()->back()->withErrors(['message' => 'Недостаточно средств для размещения оффера']);
        }

        Offer::query()->create($validated);
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
     * @return Collection
     */
    public function moveOffer(): Collection
    {
        return Offer::query()
            ->get();
    }

    /**
     * @return Collection
     */
    public function moveAdvertiser(): Collection
    {
        return Offer::query()
            ->where('advertiser_id', auth()->id())
            ->get();
    }

    /**
     * @param OfferRequest $request
     * @param Offer $offer
     * @return Offer
     */
    public function updateOffer(OfferRequest $request, Offer $offer): Offer
    {
        $validate = $request->validated();
        $offer->update($validate);
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
     * @return Collection
     * @throws OfferException
     */
    public function getListOffers(): Collection
    {
        $webmasterId = auth()->id();
        $offers = Offer::query()->where('is_active', true)->get();

        if (!$offers) {
            throw new OfferException('Offers not found');
        }

        $offers->each(function ($offer) use ($webmasterId) {
            $offer->trackingUrl = route('offer.track', [
                'offer_id' => $offer->id,
                'webmaster_id' => $webmasterId,
            ]);
        });

        return $offers;
    }

    public function getStatisticJson(): JsonResponse
    {
        $today = now()->format('Y-m-d');
        $startOfDay = "$today 00:00:00";
        $endOfDay = "$today 23:59:59";

        $clicksQuery = Click::query()
            ->whereBetween('clicked_at', [$startOfDay, $endOfDay]);

        $totalLinks = $this->getTargetUrlCountFromOffers();
        $totalClicks = $clicksQuery->count();
        $totalOffers = $this->getOffersCount();

        return response()->json([
            'totalLinks' => $totalLinks,
            'totalClicks' => $totalClicks,
            'totalOffers' => $totalOffers,
        ]);
    }
}
