<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    /**
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */
    public function balance(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('advertiser.balance');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function balanceStore(Request $request): RedirectResponse
    {
        $request->validate([
            'amount' => 'required',
        ]);

        $advertiser = Auth::user();

        $advertiser->balance += $request->input('amount');
        $advertiser->save();

        return redirect()->route('advertiser.balance')->with('success', __('Баланс успешно пополнен'));
    }

    public function getBalance(): JsonResponse
    {
        $user = auth()->user();

        return response()->json([
            'balance' => $user->balance,
        ]);
    }

}
