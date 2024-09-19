<?php

namespace App\Http\Controllers;

use App\Services\OfferSubscriptionService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OfferSubscriptionController extends Controller
{
    public function __construct(
        protected readonly OfferSubscriptionService $subscriptionService
    )
    {
        $this->middleware('role:webmaster');
    }

    public function index(): View|Factory|Application
    {
        $subscriptions = $this->subscriptionService->getAllSubscriptions();
        return view('webmaster.subscriptions.index', compact('subscriptions'));
    }

    public function create(): View|Factory|Application
    {
        $offers = $this->subscriptionService->getAllOffers();
        return view('webmaster.subscriptions.create', compact('offers'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->subscriptionService->createSubscription($request);
        return redirect()->route('webmaster.subscriptions.index')->with('success', 'Subscription created successfully');
    }

    public function show(int $subscriptionId): View|Factory|Application
    {
        $subscription = $this->subscriptionService->getSubscriptionById($subscriptionId);
        return view('webmaster.subscriptions.show', compact('subscription'));
    }
}
