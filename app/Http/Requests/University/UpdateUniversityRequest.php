<?php

namespace App\Http\Requests\University;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUniversityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'string'],
            'address' => ['sometimes', 'string', 'max:255'],
            'phone' => ['sometimes', 'string', 'max:20'],
            'email' => ['sometimes', 'email', 'max:255'],
            'website' => ['sometimes', 'url', 'max:255'],
            'logo' => ['sometimes', 'image', 'max:2048'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
} 