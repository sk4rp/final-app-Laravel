<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfferSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'webmaster_id',
        'offer_id',
        'cost_per_click',
    ];

    protected $casts = [
        'cost_per_click' => 'decimal'
    ];

    public function webmaster(): BelongsTo
    {
        return $this->belongsTo(User::class, 'webmaster_id');
    }

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class, 'offer_id');
    }
}
