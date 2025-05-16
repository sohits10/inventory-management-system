<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'rating' => 'required|in:1,2,3,4,5',
            'remarks' => 'required|string|min:5|max:500',
        ];
    }
}
