<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Services\OfferService;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    /**
     * @throws GuzzleException
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $this->offerService->createOffer($request);
            return redirect()->route('advertiser.offers.index')->with('success', 'Оффер успешно создан');
        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['error' => 'Произошла ошибка при создании оффера. Убедитесь, что стоимость за клик не слишком велика.']);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Не удалось создать оффер. Попробуйте снова.']);
        }
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
}
