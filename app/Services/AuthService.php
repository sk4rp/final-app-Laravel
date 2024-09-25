<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * @param Request $request
     * @return Model|Builder
     */
    public function registerUser(Request $request): Model|Builder
    {
        $this->validateRegistration($request);

        return User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'balance' => $request->role === RoleEnum::advertiser->value ? 0 : 1000.00,
        ]);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function validateRegistration(Request $request): void
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed',
            'role' => 'required|in:advertiser,webmaster',
        ]);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function authenticateUser(Request $request): bool
    {
        $credentials = $request->only('email', 'password');
        return Auth::attempt($credentials);
    }

    /**
     * @return void
     */
    public function logoutUser(): void
    {
        Auth::logout();
    }
}
