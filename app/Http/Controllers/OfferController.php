<?php

namespace App\Http\Controllers;

use App\Models\Click;
use App\Models\Offer;
use App\Models\SiteIncome;
use App\Services\OfferService;
use App\Services\UserService;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class OfferController extends Controller
{
    public function __construct(
        protected readonly OfferService $offerService,
        protected readonly UserService  $userService,
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
        $validated = $request->validate([
            'name' => 'required|string',
            'site_themes' => 'required',
            'target_url' => 'required|url',
            'cost_per_click' => 'required',
        ]);

        $advertiser = Auth::user();

        $validated['advertiser_id'] = $advertiser->getAuthIdentifier();

        $minTrafficCost = 100.00;

        if ($advertiser->balance < $minTrafficCost) {
            return redirect()->back()->withErrors(['message' => 'Недостаточно средств для размещения оффера']);
        }

        Offer::query()->create($validated);

        return redirect()->route('advertiser.offers.index')->with('success', 'Оффер добавлен');
    }

    /**
     * @param Offer $offer
     * @return View|\Illuminate\Foundation\Application|Factory|RedirectResponse|Application
     */
    public function edit(Offer $offer): View|\Illuminate\Foundation\Application|Factory|RedirectResponse|Application
    {
        try {
            $this->authorize('update', $offer);
            return view('advertiser.offers.edit', compact('offer'));
        } catch (AuthorizationException $e) {
            return redirect()->back()->withErrors(['error' => 'У вас нет прав для редактирования данного оффера.']);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Произошла ошибка при создании оффера. Убедитесь, что стоимость за клик не слишком велика.']);
        }
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Request $request, Offer $offer): RedirectResponse
    {
        $this->authorize('update', $offer);

        try {
            $this->offerService->updateOffer($request, $offer);
            return redirect()->route('advertiser.offers.index')->with('success', 'Оффер успешно обновлён');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['error' => 'Ошибка обновления оффера: недопустимое значение для стоимости за клик.'])->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Произошла ошибка при создании оффера. Убедитесь, что стоимость за клик не слишком велика.'])->withInput();
        }
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

    /**
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */
    public function listOffers(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $offers = Offer::query()->where('is_active', true)->get();
        return view('webmaster.offers.index', compact('offers'));
    }

    /**
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */
    public function listOffersAdvertiser(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $offers = Offer::query()->where('is_active', true)->get();
        return view('advertiser.offers.all', compact('offers'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function subscribe(Request $request): RedirectResponse
    {
        $request->validate([
            'offer_id' => 'required|exists:offers,id',
        ]);

        $advertiser = Auth::user();

        $offer = Offer::query()->find($request->offer_id);

        if ($advertiser->balance < $offer->cost_per_click) {
            return redirect()->back()->withErrors(['message' => 'Недостаточно средств для подписки на оффер']);
        }

        $advertiser->balance -= $offer->cost_per_click;
        $advertiser->save();

        return redirect()->back()->with('success', 'Вы успешно подписались на оффер');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getStatistics(Request $request): JsonResponse
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $clicksQuery = Click::query();

        if ($fromDate && $toDate) {
            $clicksQuery->whereBetween('clicked_at', [$fromDate, $toDate]);
        }

        $totalLinks = Offer::query()->distinct('target_url')->count('target_url');
        $totalClicks = $clicksQuery->count();
        $totalOffers = Offer::query()->count();

        return response()->json([
            'totalLinks' => $totalLinks,
            'totalClicks' => $totalClicks,
            'totalOffers' => $totalOffers,
        ]);
    }

    /**
     * @return View
     */
    public function stats(): View
    {
        $totalLinks = Offer::query()->distinct('target_url')->count('target_url');
        $totalClicks = Click::query()->count();
        $totalOffers = Offer::query()->count();

        return view('webmaster.dashboard', compact('totalLinks', 'totalClicks', 'totalOffers'));
    }

    public function statsAdvertiser(): View
    {
        $offers = Offer::query()->where('advertiser_id', auth()->id())->get();

        $totalClicksByOffer = $offers->map(function ($offer) {
            return [
                'offer_id' => $offer->id,
                'click_count' => $offer->clicks()->count(),
                'target_url' => $offer->target_url,
            ];
        });

        $totalLinks = $offers->pluck('target_url')->unique()->count();
        $totalClicks = Click::query()->whereIn('offer_id', $offers->pluck('id'))->count();
        $totalOffers = $offers->count();

        return view('advertiser.dashboard', compact('totalLinks', 'totalClicks', 'totalOffers', 'totalClicksByOffer'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function advertiserStatstoJson(Request $request): JsonResponse
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $clicksQuery = Click::query()
            ->whereHas('offer', function ($query) {
                $query->where('advertiser_id', auth()->id());
            });

        if ($fromDate && $toDate) {
            $clicksQuery->whereBetween('clicked_at', [$fromDate, $toDate]);
        }

        $totalLinks = Offer::query()->where('advertiser_id', auth()->id())->distinct('target_url')->count('target_url');
        $totalClicks = $clicksQuery->count();
        $totalOffers = Offer::query()->where('advertiser_id', auth()->id())->count();

        return response()->json([
            'totalLinks' => $totalLinks,
            'totalClicks' => $totalClicks,
            'totalOffers' => $totalOffers,
        ]);
    }

    /**
     * @return View
     */
    public function moveAdvertiserOffers(): View
    {
        $offers = $this->offerService->moveAdvertiser();
        return view('advertiser.offers.move', compact('offers'));
    }

    /**
     * @param Offer $offer
     * @return JsonResponse
     */
    public function activateOffer(Offer $offer): JsonResponse
    {
        if ($offer->advertiser_id !== auth()->id()) {
            abort(403, 'Unauthorized action');
        }

        $offer->update(['is_active' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * @param Offer $offer
     * @return JsonResponse
     */
    public function deactivateOffer(Offer $offer): JsonResponse
    {
        if ($offer->advertiser_id !== auth()->id()) {
            abort(403, 'Unauthorized action');
        }

        $offer->update(['is_active' => false]);

        return response()->json(['success' => true]);
    }

    /**
     * @param int $offerId
     * @return JsonResponse|RedirectResponse
     */
    public function processClick(int $offerId): JsonResponse|RedirectResponse // TODO: надо доделать
    {
        $offer = Offer::query()->find($offerId);

        if (!$offer) {
            return response()->json(['error' => 'Оффер не найден'], 404);
        }

        $webmasters = $offer->subscriptions()->with('webmaster')->get();

        // Предполагается, что вы работаете с первым веб-мастером
        if ($webmasters->isEmpty()) {
            return response()->json(['error' => 'Веб-мастера не найдены'], 404);
        }

        $webmaster = $webmasters->first()->webmaster;

        $advertiser = $offer->advertiser;
        $siteIncome = SiteIncome::query()->first();

        $clickCost = $offer->cost_per_click;
        $webmasterShare = 0.8 * $clickCost;
        $siteShare = 0.2 * $clickCost;

        if ($advertiser->balance >= $clickCost) {
            $advertiser->updateBalance(-$clickCost);
            $webmaster->updateBalance($webmasterShare);
            $siteIncome?->addIncome($siteShare);

            return redirect()->to($offer->target_url);
        }

        return response()->json(['error' => 'Недостаточно средств у рекламодателя'], 400);
    }
}
