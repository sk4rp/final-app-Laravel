<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Exceptions\CalculationException;
use App\Models\Click;
use App\Models\SiteIncome;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ClickService
{
    /**
     * @param int $userId
     * @return Collection
     */
    public function getUserClicks(int $userId): Collection
    {
        return Click::query()
            ->where('webmaster_id', $userId)
            ->get();
    }

    /**
     * @return int
     */
    public function getCountClicks(): int
    {
        return Click::query()->count();
    }

    /**
     * @param array $params
     * @return Model|Builder
     */
    public function createClick(array $params): Model|Builder
    {
        return Click::query()->create($params);
    }

    /**
     * @throws CalculationException
     */
    public function calculateClicks(mixed $offer, mixed $webmaster): void
    {
        try {
            $clickPrice = $offer->cost_per_click;

            $webmaster->balance += $clickPrice * 0.8;
            $webmaster->save();

            $advertiser = $offer->advertiser;
            $advertiser->balance -= $clickPrice;
            $advertiser->save();

            $adminShare = $clickPrice * 0.2;
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
        } catch (CalculationException $e) {
            throw new CalculationException($e->getMessage());
        }
    }
}
