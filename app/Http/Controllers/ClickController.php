<?php

namespace App\Http\Controllers;

use App\Services\ClickService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ClickController extends Controller
{
    public function __construct(
        protected readonly ClickService $clickService
    )
    {
        $this->middleware('role:webmaster');
    }

    public function index(): Application|Factory|View
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, 'Access denied');
        }

        $clicks = $this->clickService->getUserClicks($user->id);

        return view('webmaster.clicks.index', compact('clicks'));
    }

    public function handleRedirect(Request $request, int $offerId): RedirectResponse|Redirector|Application
    {
        try {
            $redirectUrl = $this->clickService->handleRedirect($offerId, $request);
            return redirect($redirectUrl);
        } catch (\Exception $e) {
            abort(403, $e->getMessage());
        }
    }
}
