<?php



namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutUsRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|array',
            'content.paragraphs' => 'required|array',
            'content.paragraphs.*.text' => 'required|string',
            'content.paragraphs.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Image validation
            'content.paragraphs.*.points' => 'nullable|array',
            'content.paragraphs.*.points.*' => 'string',
        ];
    }


    public function authorize(): bool
    {
        return true;
    }
}
