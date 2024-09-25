<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteIncome extends Model
{
    use HasFactory;

    protected $table = 'site_incomes';

    protected $fillable = ['total_income'];

    public function addIncome(float $amount): void
    {
        $this->total_income += $amount;
        $this->save();
    }
}
