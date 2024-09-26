<?php

namespace App\Http\Controllers;

use App\Exceptions\OfferException;
use App\Http\Requests\OfferRequest;
use App\Models\Click;
use App\Models\Offer;
use App\Services\ClickService;
use App\Services\OfferService;
use App\Services\UserService;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class OfferController extends Controller
{
    public function __construct(
        protected readonly OfferService $offerService,
        protected readonly UserService  $userService,
        protected readonly ClickService $clickService,
    )
    {
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $offers = $this->offerService->getUserOffers(auth()->user()->id);
        return view('advertiser.offers.index', compact('offers'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('advertiser.offers.create');
    }

    public function store(OfferRequest $request): RedirectResponse
    {
        $this->offerService->createOffer($request);
        return redirect()->route('advertiser.offers.index')->with('success', 'Оффер добавлен');
    }

    /**
     * @param Offer $offer
     * @return Application|Factory|View|\Illuminate\Foundation\Application|RedirectResponse
     */
    public function edit(Offer $offer): Factory|View|\Illuminate\Foundation\Application|Application|RedirectResponse
    {
        try {
            $this->authorize('update', $offer);
            return view('advertiser.offers.edit', compact('offer'));
        } catch (AuthorizationException $e) {
            return redirect()->back()->withErrors(['error' => 'У вас нет прав для редактирования данного оффера']);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Произошла ошибка при создании оффера. Убедитесь, что стоимость за клик не слишком велика']);
        }
    }

    /**
     * @throws AuthorizationException
     */
    public function update(OfferRequest $request, Offer $offer): RedirectResponse
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
     * @throws OfferException
     */
    public function listOffers(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $offers = $this->offerService->getListOffers();
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
     * @return JsonResponse
     */
    public function getStatistics(): JsonResponse
    {
        return $this->offerService->getStatisticJson();
    }

    /**
     * @return View
     */
    public function stats(): View
    {
        $totalLinks = $this->offerService->getTargetUrlCountFromOffers();
        $totalClicks = $this->clickService->getCountClicks();
        $totalOffers = $this->offerService->getOffersCount();
        return view('webmaster.dashboard', compact('totalLinks', 'totalClicks', 'totalOffers'));
    }

    /**
     * @return View
     */
    public function statsAdvertiser(): View
    {
        $advertiser = auth()->user();
        $offers = $advertiser->offers;

        $totalClicks = Click::query()->whereIn('offer_id', $offers->pluck('id'))->count();
        $totalLinks = $offers->pluck('target_url')->unique()->count();
        $totalOffers = $offers->count();

        $clickDates = Click::query()
            ->whereIn('offer_id', $offers->pluck('id'))
            ->pluck('clicked_at')
            ->map(function ($date) {
                return Carbon::createFromTimestamp($date)->toDateTimeString();
            })
            ->unique();

        return view('advertiser.dashboard', compact('totalClicks', 'totalLinks', 'totalOffers', 'clickDates'));
    }

    /**
     * @return JsonResponse
     */
    public function advertiserStatstoJson(): JsonResponse
    {
        $advertiser = auth()->user();
        $offers = $advertiser->offers;

        $clicksQuery = Click::query()->whereIn('offer_id', $offers->pluck('id'));
        $clicks = $clicksQuery->get();
        $totalClicks = $clicks->count();

        $clickDates = $clicks->pluck('clicked_at')->map(function ($date) {
            return Carbon::createFromTimestamp($date)->toDateTimeString();
        })->unique();

        $totalLinks = $offers->pluck('target_url')->unique()->count();
        $totalOffers = $offers->count();

        return response()->json([
            'totalLinks' => $totalLinks,
            'clickDates' => $clickDates,
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
}
