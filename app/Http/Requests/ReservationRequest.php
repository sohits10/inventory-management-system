<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow all users to make reservations
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'date' => 'required|date',
            'time' => 'required',
            'guest_count' => 'required|integer|min:1',  // Minimum 1 guest
            'special_requests' => 'nullable|string|max:500',  // Optional, max 500 characters
            'status' => 'in:pending,confirmed,canceled,completed',  // Valid statuses
        ];
    }

    public function messages(){
        return[
            'reservation_datetime.after' => 'The reservation time must be in the future.',
            'guest_count.min' => 'You must reserve for at least one guest.',
        ];
    }
}
