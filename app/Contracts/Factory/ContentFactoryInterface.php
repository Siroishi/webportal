<?php

namespace App\Contracts\Factory;

interface ContentFactoryInterface
{
    public function create(array $data): array;
    public function createMany(array $items): array;
} 