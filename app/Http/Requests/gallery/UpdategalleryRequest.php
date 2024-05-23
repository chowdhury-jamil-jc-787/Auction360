<?php

namespace App\Http\Requests\gallery;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdategalleryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $galleryValidationRule = 'mimes:jpg,png,jpeg,webp|max:1000';

        return [
            'name' => [
                'required',
                Rule::unique('galleries', 'name')->ignore($this->route('gallery')) // Adjusting unique rule for update
            ],
            'is_active' => ['required'],
            'created_at' => ['required'],
            'image' => $galleryValidationRule // Validation rules for the image
        ];
    }
}
