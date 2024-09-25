<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\User
 * @property int $id
 * @property string $email
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'balance',
    ];

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class, 'advertiser_id');
    }

    /**
     * @param float $amount
     * @return void
     */
    public function updateBalance(float $amount): void
    {
        $this->balance += $amount;
        $this->save();
    }
}
