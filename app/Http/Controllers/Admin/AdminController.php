<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Click;
use App\Models\Offer;
use App\Models\User;
use App\Services\ClickService;
use App\Services\OfferService;
use App\Services\UserService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function __construct(
        protected readonly OfferService $offerService,
        protected readonly UserService  $userService,
        protected readonly ClickService $clickService,
    )
    {
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $totalOffers = $this->offerService->getOffers()->count();
        $totalUsers = $this->userService->getAllUsers()->count();
        $totalClicks = $this->clickService->getCountClicks();
        return view('admin.dashboard', compact('totalOffers', 'totalUsers', 'totalClicks'));
    }

    /**
     * @return JsonResponse
     */
    public function statisticToJson(): JsonResponse
    {
        $totalOffers = $this->offerService->getOffers()->count();
        $totalUsers = $this->userService->getAllUsers()->count();
        $totalClicks = $this->clickService->getCountClicks();

        return response()->json([
            'totalOffers' => $totalOffers,
            'totalUsers' => $totalUsers,
            'totalClicks' => $totalClicks,
        ]);
    }

    /**
     * @return View
     */
    public function users(): View
    {
        $users = $this->userService->getAllUsers();
        return view('admin.users.index', compact('users'));
    }

    /**
     * @param Offer $offer
     * @return View
     */
    public function editOffer(Offer $offer): View
    {
        return view('admin.offers.edit', compact('offer'));
    }

    /**
     * @param Request $request
     * @param Offer $offer
     * @return RedirectResponse
     */
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

    /**
     * @param Offer $offer
     * @return RedirectResponse
     */
    public function destroyOffer(Offer $offer): RedirectResponse
    {
        $this->offerService->deleteOffer($offer);
        return redirect()->route('admin.offers.index')->with('success', 'Оффер успешно удалён');
    }

    /**
     * @param User $user
     * @return View
     */
    public function editUser(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function updateUser(Request $request, User $user): RedirectResponse
    {
        $this->userService->updateUser($request, $user->id);
        return redirect()->route('admin.users.index')->with('success', 'Пользователь успешно обновлён');
    }

    /**
     * @param int $userId
     * @return RedirectResponse
     */
    public function destroyUser(int $userId): RedirectResponse
    {
        $this->userService->deleteUser($userId);

        return redirect()->route('admin.users.index')->with('success', 'Пользователь успешно удалён.');
    }

    /**
     * @return View
     */
    public function offers(): View
    {
        $offers = $this->offerService->getOffers();
        return view('admin.offers.index', compact('offers'));
    }

    /**
     * @param int $offerId
     * @return RedirectResponse
     */
    public function deactivateOffer(int $offerId): RedirectResponse
    {
        $this->offerService->deactivateOffer($offerId);

        return redirect()->route('admin.offers.index')->with('success', 'Оффер успешно деактивирован.');
    }

    /**
     * @param int $offerId
     * @return RedirectResponse
     */
    public function activateOffer(int $offerId): RedirectResponse
    {
        $this->offerService->activateOffer($offerId);

        return redirect()->route('admin.offers.index')->with('success', 'Оффер успешно активирован.');
    }

    /**
     * @return View
     */
    public function moveDragDrop(): View
    {
        $offers = $this->offerService->moveOffer();
        return view('admin.offers.move', compact('offers'));
    }
}
