<?php

namespace App\Http\Controllers;

use App\Services\OfferSubscriptionService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OfferSubscriptionController extends Controller
{
    public function __construct(
        protected readonly OfferSubscriptionService $subscriptionService
    )
    {
        $this->middleware('role:webmaster');
    }

    /**
     * @return View|Factory|Application
     */
    public function index(): View|Factory|Application
    {
        $subscriptions = $this->subscriptionService->getAllSubscriptions();
        return view('webmaster.subscriptions.index', compact('subscriptions'));
    }

    /**
     * @return View|Factory|Application
     */
    public function create(): View|Factory|Application
    {
        $offers = $this->subscriptionService->getAllOffers();
        return view('webmaster.subscriptions.create', compact('offers'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $subscription = $this->subscriptionService->createSubscription($request);
            return response()->json(['message' => 'Подписка успешно создана', 'subscription' => $subscription]);
        } catch (\Exception $e) {
            Log::error('Ошибка при создании подписки: ', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Ошибка при создании подписки', 'error' => $e->getMessage()], 500);
        }
    }


    /**
     * @param int $subscriptionId
     * @return View|Factory|Application
     */
    public function show(int $subscriptionId): View|Factory|Application
    {
        $subscription = $this->subscriptionService->getSubscriptionById($subscriptionId);
        $trackingUrl = route('offer.track', [
            'offer_id' => $subscription->offer_id,
            'webmaster_id' => $subscription->webmaster_id
        ]);

        return view('webmaster.subscriptions.show', compact('subscription', 'trackingUrl'));
    }
}
