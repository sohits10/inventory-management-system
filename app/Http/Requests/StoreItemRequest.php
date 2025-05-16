<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    public function authorize()
    {
        // You can customize authorization logic here if necessary
        return true;
    }

    public function rules()
    {
        return [
            'item_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'special_instruction' => 'nullable|string',
        ];
    }

    // Optionally, you can customize the messages if needed
    public function messages()
    {
        return [
            'image_path.image' => 'The uploaded file must be an image.',
            'image_path.mimes' => 'The image must be of type: jpg, jpeg, png, gif.',
            'image_path.max' => 'The image may not be greater than 2MB.',
        ];
    }
}
