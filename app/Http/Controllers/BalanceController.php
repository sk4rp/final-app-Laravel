<?php

namespace App\Http\Controllers;

use App\Exceptions\UserException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    /**
     * @return View
     */
    public function balance(): View
    {
        return view('advertiser.balance');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws UserException
     */
    public function balanceStore(Request $request): RedirectResponse
    {
        $request->validate([
            'balance' => 'required|numeric|min:1|max:500000',
        ]);

        $advertiser = auth()->user();

        if (!$advertiser) {
            throw new UserException('User not found');
        }

        $advertiser->balance += $request->input('balance');
        $advertiser->save();

        return redirect()->route('advertiser.balance')->with('success', __('Баланс успешно пополнен'));
    }

    /**
     * @return JsonResponse
     */
    public function getBalance(): JsonResponse
    {
        $user = auth()->user();

        return response()->json([
            'balance' => $user->balance,
        ]);
    }

}
