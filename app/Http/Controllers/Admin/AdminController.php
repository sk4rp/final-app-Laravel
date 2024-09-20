<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Click;
use App\Models\Expense;
use App\Models\Offer;
use App\Models\User;
use App\Services\OfferService;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(
        protected readonly OfferService $offerService,
        protected readonly UserService  $userService,
    )
    {
    }

    public function index(): View
    {
        $totalOffers = $this->offerService->getOffers()->count();
        $totalUsers = $this->userService->getAllUsers()->count();
        $totalClicks = Click::query()->count();

        return view('admin.dashboard', compact('totalOffers', 'totalUsers', 'totalClicks'));
    }

    public function users(): View
    {
        $users = $this->userService->getAllUsers();
        return view('admin.users.index', compact('users'));
    }

    public function editOffer(Offer $offer): View
    {
        return view('admin.offers.edit', compact('offer'));
    }

    public function updateOffer(Request $request, Offer $offer): RedirectResponse
    {
        $this->offerService->updateOffer($request, $offer);
        return redirect()->route('admin.offers.index')->with('success', 'Оффер успешно обновлён');
    }

    public function destroyOffer(Offer $offer): RedirectResponse
    {
        $this->offerService->deleteOffer($offer);
        return redirect()->route('admin.offers.index')->with('success', 'Оффер успешно удалён');
    }

    public function editUser(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user): RedirectResponse
    {
        $this->userService->updateUser($request, $user->id);
        return redirect()->route('admin.users.index')->with('success', 'Пользователь успешно обновлён');
    }

    public function destroyUser(int $userId): RedirectResponse
    {
        $this->userService->deleteUser($userId);

        return redirect()->route('admin.users.index')->with('success', 'Пользователь успешно удалён.');
    }

    public function offers(): View
    {
        $offers = $this->offerService->getOffers();
        return view('admin.offers.index', compact('offers'));
    }

    public function deactivateOffer(int $offerId): RedirectResponse
    {
        $this->offerService->deactivateOffer($offerId);

        return redirect()->route('admin.offers.index')->with('success', 'Оффер успешно деактивирован.');
    }

    public function activateOffer(int $offerId): RedirectResponse
    {
        $this->offerService->activateOffer($offerId);

        return redirect()->route('admin.offers.index')->with('success', 'Оффер успешно активирован.');
    }

    public function systemStatistics(): View
    {
        $totalClicks = Click::query()->count();
        $totalRefusals = Click::query()->where('status', 'refused')->count();
        $totalRedirects = Click::query()->where('status', 'redirected')->count();
        $totalIncome = Expense::query()->sum('amount');

        return view('admin.statistics', compact('totalClicks', 'totalRefusals', 'totalRedirects', 'totalIncome'));
    }
}
