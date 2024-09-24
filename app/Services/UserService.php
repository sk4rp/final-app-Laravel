<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserService
{
    /**
     * @return Collection|array
     */
    public function getAllUsers(): Collection|array
    {
        return User::query()->get();
    }

    /**
     * @param Request $request
     * @param int $userId
     * @return Model|Collection|Builder|array|null
     */
    public function updateUser(Request $request, int $userId): Model|Collection|Builder|array|null
    {
        $user = User::query()->findOrFail($userId);
        $user->update($request->only('name', 'email', 'role', 'is_active'));

        return $user;
    }

    /**
     * @param int $userId
     * @return void
     */
    public function deleteUser(int $userId): void
    {
        $user = User::query()->findOrFail($userId);

        if ($user->role === RoleEnum::admin->value) {
            return;
        }

        $user->delete();
    }
}
