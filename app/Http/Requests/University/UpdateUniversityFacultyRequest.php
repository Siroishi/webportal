<?php

namespace App\Http\Requests\University;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUniversityFacultyRequest extends FormRequest
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
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
} 