<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Click;
use App\Models\Offer;
use App\Models\User;
use App\Services\OfferService;
use App\Services\UserService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
        try {
            $this->offerService->updateOffer($request, $offer);
            return redirect()->route('admin.offers.index')->with('success', 'Оффер успешно обновлён');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['error' => 'Ошибка обновления оффера: недопустимое значение для стоимости за клик'])->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Не удалось обновить оффер. Попробуйте снова позже'])->withInput();
        }
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
}
