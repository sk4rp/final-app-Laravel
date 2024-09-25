<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\OfferSubscription;
use App\Services\OfferSubscriptionService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $offerId = $request->input('offer_id');
        $user = auth()->user();
        $userId = $user->id;

        $subscriptionExists = OfferSubscription::query()
            ->where('offer_id', $offerId)
            ->where('webmaster_id', $userId)
            ->exists();

        if ($subscriptionExists) {
            return response()->json(['exists' => true, 'message' => 'Вы уже подписаны на этот оффер'], 400);
        }

        $offer = Offer::query()->find($offerId);
        if (!$offer) {
            return response()->json(['message' => 'Оффер не найден'], 404);
        }

        if ($user->balance < $offer->cost_per_click) {
            return response()->json(['message' => 'Недостаточно средств на балансе для подписки'], 400);
        }

        try {
            DB::beginTransaction();

            $subscription = OfferSubscription::query()->create([
                'offer_id' => $offerId,
                'webmaster_id' => $userId,
                'cost_per_click' => $offer->cost_per_click,
            ]);

            DB::commit();

            return response()->json(['success' => true, 'subscription' => $subscription]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Ошибка при подписке: ' . $e->getMessage()], 500);
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
