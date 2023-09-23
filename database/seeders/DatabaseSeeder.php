<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => [
                    'ru' => 'Гражданское право',
                    'ky' => 'text',
                ],
            ],
            [
                'title' => [
                    'ru' => 'Здравохранение',
                    'ky' => 'text',
                ],
            ],
            [
                'title' => [
                    'ru' => 'Уголовное право',
                    'ky' => 'text',
                ],
            ],
        ];

        foreach ($data as $item) {
            Category::query()->create($item);
        }
    }
}
