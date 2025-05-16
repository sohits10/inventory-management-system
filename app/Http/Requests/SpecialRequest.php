<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecialRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Authorize all users for now
    }

    public function rules()
    {
        return [
            'item_id' => 'nullable|exists:items,id',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ];
    }
}
