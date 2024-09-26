<?php

namespace App\Http\Controllers;

use App\Exceptions\CalculationException;
use App\Exceptions\OfferException;
use App\Exceptions\UserException;
use App\Services\ClickService;
use App\Services\OfferService;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ClickController extends Controller
{
    public function __construct(
        protected readonly ClickService $clickService,
        protected readonly OfferService $offerService,
        protected readonly UserService  $userService,
    )
    {
        $this->middleware('role:webmaster');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, 'Access denied');
        }

        $clicks = $this->clickService->getUserClicks($user->id);

        return view('webmaster.clicks.index', compact('clicks'));
    }

    /**
     * @param $offer_id
     * @param $webmaster_id
     * @return RedirectResponse
     * @throws OfferException
     * @throws UserException
     * @throws CalculationException
     */
    public function track($offer_id, $webmaster_id): RedirectResponse
    {
        $offer = $this->offerService->findOfferByIt($offer_id);
        $webmaster = $this->userService->findWebmasterById($webmaster_id);

        $paramsToClick = [
            'offer_id' => $offer_id,
            'webmaster_id' => $webmaster_id,
            'client_ip' => request()?->getClientIp() ?? '127.0.0.1',
            'clicked_at' => now(),
        ];

        $this->clickService->createClick($paramsToClick);
        $this->clickService->calculateClicks($offer, $webmaster);

        return redirect($offer->target_url);
    }
}
