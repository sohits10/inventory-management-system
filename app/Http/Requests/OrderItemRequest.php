<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'order_id' => 'required|exists:orders,id',
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'sub_total' => 'required|integer|min:0',
        ];
    }
}
