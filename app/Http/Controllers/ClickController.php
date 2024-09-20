<?php

namespace App\Http\Controllers;

use App\Models\OfferSubscription;
use App\Services\ClickService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;

class ClickController extends Controller
{
    public function __construct(
        protected readonly ClickService $clickService
    )
    {
        $this->middleware('role:webmaster');
    }

    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, 'Access denied');
        }

        $clicks = $this->clickService->getUserClicks($user->id);

        return view('webmaster.clicks.index', compact('clicks'));
    }

    public function track(Request $request): Application|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $offerId = $request->input('offer_id');
        $webmasterId = $request->input('webmaster_id');

        $subscription = OfferSubscription::query()
            ->where('offer_id', $offerId)
            ->where('webmaster_id', $webmasterId)
            ->first();

        if (!$subscription) {
            Log::warning("Error with subscription: webmaster_id={$webmasterId}, offer_id={$offerId}");
            return redirect('/');
        }

        Log::info("Tracking click for offer {$offerId} by webmaster {$webmasterId}");

        return redirect($subscription->offer->target_url);
    }
}
