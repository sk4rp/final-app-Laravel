<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Services\OfferService;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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
            // Обработка ошибок базы данных (например, превышение допустимого значения)
            return redirect()->back()->withErrors(['error' => 'Ошибка обновления оффера: недопустимое значение для стоимости за клик.'])->withInput();
        } catch (Exception $e) {
            // Общая обработка других исключений
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

    public function listOffersAdvertiser(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $offers = Offer::query()->where('is_active', true)->get();
        return view('advertiser.offers.all', compact('offers'));
    }

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
}
