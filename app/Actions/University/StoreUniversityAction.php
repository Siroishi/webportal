<?php

namespace App\Actions\University;

use App\DTO\University\UniversityDTO;
use App\Models\University;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StoreUniversityAction
{
    public function execute(UniversityDTO $dto): University
    {
        $logo = $dto->logo;
        $logoPath = 'universities/' . Str::random(40) . '.' . $logo->getClientOriginalExtension();
        Storage::disk('public')->put($logoPath, file_get_contents($logo));

        return University::create([
            'name' => $dto->name,
            'slug' => Str::slug($dto->name),
            'description' => $dto->description,
            'address' => $dto->address,
            'phone' => $dto->phone,
            'email' => $dto->email,
            'website' => $dto->website,
            'logo' => $logoPath,
            'is_active' => $dto->is_active,
        ]);
    }
} 