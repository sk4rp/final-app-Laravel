<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'site_themes' => 'required',
            'target_url' => 'required|url',
            'cost_per_click' => 'required',
        ];
    }
}
