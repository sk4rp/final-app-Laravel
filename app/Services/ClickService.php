<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Models\Click;
use App\Models\Offer;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClickService
{
    /**
     * @param int $userId
     * @return Collection|array
     */
    public function getUserClicks(int $userId): Collection|array
    {
        return Click::query()->where('webmaster_id', $userId)->get();
    }

    /**
     * @param int $offerId
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function handleRedirect(int $offerId, Request $request): mixed
    {
        $user = Auth::user();

        if (!$user) {
            throw new Exception('Access denied');
        }

        if ($user->role !== RoleEnum::admin->value && $user->role !== RoleEnum::webmaster->value) {
            throw new Exception('Access denied');
        }

        $offer = Offer::query()->findOrFail($offerId);

        $webmasterId = $user->getAuthIdentifier();

        if (!$offer->subscriptions()->where('user_id', $webmasterId)->exists()) {
            throw new Exception('Subscription not found');
        }

        Click::query()->create([
            'offer_id' => $offerId,
            'webmaster_id' => $webmasterId,
            'client_ip' => $request->ip(),
            'clicked_at' => now(),
        ]);

        return $offer->target_url;
    }
}
