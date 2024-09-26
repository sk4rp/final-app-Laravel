<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(
        protected readonly AuthService $authService
    )
    {
    }

    /**
     * @return View
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        if ($this->authService->authenticateUser($request)) {
            return redirect()->route('home');
        }

        return redirect()->back()->withErrors(['email' => 'Неправильный email или пароль']);
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        $this->authService->logoutUser();
        return redirect()->route('login');
    }
}
