<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'site_name_ru' => env('APP_NAME', 'Laravel'),
            'site_name_ua' => env('APP_NAME', 'Laravel'),
        ];

        Setting::firstOrCreate([], [
            'data' => $data
        ]);

    }
}
