<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'target_url',
        'site_themes',
        'advertiser_id',
        'cost_per_click',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * @return BelongsTo
     */
    public function advertiser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'advertiser_id');
    }

    /**
     * @return HasMany
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(OfferSubscription::class);
    }

    /**
     * @return HasMany
     */
    public function clicks(): HasMany
    {
        return $this->hasMany(Click::class);
    }

    /**
     * @return HasManyThrough
     */
    public function webmaster(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, OfferSubscription::class, 'offer_id', 'id', 'id', 'webmaster_id');
    }
}
