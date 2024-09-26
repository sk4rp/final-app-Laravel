<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Exceptions\UserException;
use App\Models\Click;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserService
{
    /**
     * @return Collection
     */
    public function getAllUsers(): Collection
    {
        return User::query()->get();
    }

    /**
     * @param int $webmasterId
     * @return Model|Collection|Builder|array
     * @throws UserException
     */
    public function findWebmasterById(int $webmasterId): Model|Collection|Builder|array
    {
        $webmaster = User::query()->find($webmasterId);

        if (!$webmaster) {
            throw new UserException('Webmaster not found');
        }

        return $webmaster;
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

        Click::query()->where('webmaster_id', $userId)->delete();
        $user->delete();
    }
}
