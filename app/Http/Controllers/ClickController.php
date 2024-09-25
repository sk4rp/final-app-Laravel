<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\Click;
use App\Models\Offer;
use App\Models\SiteIncome;
use App\Models\User;
use App\Services\ClickService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

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

    public function track($offer_id, $webmaster_id): Application|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $offer = Offer::query()->find($offer_id);
        $webmaster = User::query()->find($webmaster_id);

        if (!$offer || !$webmaster) {
            abort(404, 'Offer or Webmaster not found');
        }

        Click::query()->create([
            'offer_id' => $offer_id,
            'webmaster_id' => $webmaster_id,
            'client_ip' => request()?->getClientIp() ?? '127.0.0.1',
            'clicked_at' => now(),
        ]);

        $clickPrice = $offer->cost_per_click;

        $webmaster->balance += $clickPrice * 0.8; // 80% вебмастеру
        $webmaster->save();

        $advertiser = $offer->advertiser;
        $advertiser->balance -= $clickPrice; // Списание у рекламодателя
        $advertiser->save();

        $adminShare = $clickPrice * 0.2; // 20% администратору
        $admins = User::query()->where('role', RoleEnum::admin->value)->get();

        foreach ($admins as $admin) {
            $admin->balance += $adminShare;
            $admin->save();
        }

        $siteIncomes = SiteIncome::query()->get();
        foreach ($siteIncomes as $siteIncome) {
            $siteIncome->total_income += $adminShare;
            $siteIncome->save();
        }

        return redirect($offer->target_url);
    }
}
