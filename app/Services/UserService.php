<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserService
{
    public function getAllUsers(): Collection|array
    {
        return User::query()->get();
    }

    public function getUserById(int $userId): Model|Collection|Builder|array|null
    {
        return User::query()->findOrFail($userId);
    }

    public function updateUser(Request $request, int $userId): Model|Collection|Builder|array|null
    {
        $user = User::query()->findOrFail($userId);
        $user->update($request->only('name', 'email', 'role', 'is_active'));

        return $user;
    }

    public function deleteUser(int $userId): void
    {
        $user = User::query()->findOrFail($userId);
        $user->delete();
    }
}
