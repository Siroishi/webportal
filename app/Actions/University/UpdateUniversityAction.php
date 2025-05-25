<?php

namespace App\Actions\University;

use App\DTO\University\UniversityDTO;
use App\Models\University;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateUniversityAction
{
    public function execute(University $university, UniversityDTO $dto): University
    {
        $data = [
            'name' => $dto->name,
            'slug' => Str::slug($dto->name),
            'description' => $dto->description,
            'address' => $dto->address,
            'phone' => $dto->phone,
            'email' => $dto->email,
            'website' => $dto->website,
            'is_active' => $dto->is_active,
        ];

        if ($dto->logo) {
            Storage::disk('public')->delete($university->logo);
            $logoPath = 'universities/' . Str::random(40) . '.' . $dto->logo->getClientOriginalExtension();
            Storage::disk('public')->put($logoPath, file_get_contents($dto->logo));
            $data['logo'] = $logoPath;
        }

        $university->update($data);
        return $university;
    }
} 