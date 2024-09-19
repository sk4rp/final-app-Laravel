<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Services\OfferService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function __construct(
        protected readonly OfferService $offerService
    )
    {
    }

    public function index(): View|Factory|Application
    {
        $offers = $this->offerService->getUserOffers(auth()->user()->id);
        return view('advertiser.offers.index', compact('offers'));
    }

    public function create(): View|Factory|Application
    {
        return view('advertiser.offers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->offerService->createOffer($request);
        return redirect()->route('advertiser.offers.index')->with('success', 'Оффер успешно создан');
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Offer $offer): View|Factory|Application
    {
        $this->authorize('update', $offer);
        return view('advertiser.offers.edit', compact('offer'));
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Request $request, Offer $offer): RedirectResponse
    {
        $this->authorize('update', $offer);
        $this->offerService->updateOffer($request, $offer);
        return redirect()->route('advertiser.offers.index')->with('success', 'Оффер успешно обновлён');
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Offer $offer): RedirectResponse
    {
        $this->authorize('delete', $offer);
        $this->offerService->deleteOffer($offer);
        return redirect()->route('advertiser.offers.index')->with('success', 'Оффер успешно удалён');
    }
}
