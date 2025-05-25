<?php

namespace App\Http\Requests\University;

use Illuminate\Foundation\Http\FormRequest;

class StoreUniversityFacultyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'is_active' => ['boolean'],
        ];
    }
} 