<?php

namespace App\Http\Requests\gallery;

use Illuminate\Foundation\Http\FormRequest;

class StoregalleryRequest extends FormRequest
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
        $galleryValidationRole = 'mimes:jpg,png,jpeg,webp|max:1000';
        if ($this->isMethod('post')) {
            $galleryValidationRole = 'required|' . $galleryValidationRole;
        }

        return [
            'name' => ['required', 'unique:galleries,name'],
            'is_active' => ['required'],
            'image' => $galleryValidationRole // Assign the generated validation rules directly
        ];
    }
}
