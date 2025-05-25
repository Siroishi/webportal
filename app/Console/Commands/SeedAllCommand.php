<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeedAllCommand extends Command
{
    protected $signature = 'seed:all';
    protected $description = 'Запуск всех сидеров для новостей, базы знаний и университетов';

    public function handle(): int
    {
        $this->info('Начинаем заполнение базы данных...');

        $this->info('Запуск сидера новостей...');
        Artisan::call('db:seed', ['--class' => 'NewsSeeder']);
        $this->info('Сидер новостей выполнен успешно');

        $this->info('Запуск сидера базы знаний...');
        Artisan::call('db:seed', ['--class' => 'KnowledgeSeeder']);
        $this->info('Сидер базы знаний выполнен успешно');

        $this->info('Запуск сидера университетов...');
        Artisan::call('db:seed', ['--class' => 'UniversitySeeder']);
        $this->info('Сидер университетов выполнен успешно');

        $this->info('Все сидеры успешно выполнены!');

        return self::SUCCESS;
    }
} 