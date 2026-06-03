<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [

            [
                'slug' => 'home',
                'template' => 'home',
                'translations' => [
                    'ru' => [
                        'title' => 'Главная',
                    ],
                    'ua' => [
                        'title' => 'Головна',
                    ],
                ],
            ],

            [
                'slug' => 'about',
                'template' => 'about',
                'translations' => [
                    'ru' => [
                        'title' => 'О нас',
                    ],
                    'ua' => [
                        'title' => 'Про нас',
                    ],
                ],
            ],

            [
                'slug' => 'services',
                'template' => 'services',
                'translations' => [
                    'ru' => [
                        'title' => 'Услуги',
                    ],
                    'ua' => [
                        'title' => 'Послуги',
                    ],
                ],
            ],

            [
                'slug' => 'contacts',
                'template' => 'contacts',
                'translations' => [
                    'ru' => [
                        'title' => 'Контакты',
                    ],
                    'ua' => [
                        'title' => 'Контакти',
                    ],
                ],
            ],

            [
                'slug' => 'delivery',
                'template' => 'delivery',
                'translations' => [
                    'ru' => [
                        'title' => 'Доставка',
                    ],
                    'ua' => [
                        'title' => 'Доставка',
                    ],
                ],
            ],

            [
                'slug' => 'faq',
                'template' => 'list',
                'translations' => [
                    'ru' => [
                        'title' => 'Faq',
                    ],
                    'ua' => [
                        'title' => 'Faq',
                    ],
                ],
            ],


            'slug' => 'reviews',
            'template' => 'list',
            'translations' => [
                'ru' => [
                    'title' => 'Отзывы',
                ],
                'ua' => [
                    'title' => 'Отзывы',
                ],
            ],


        ];

        foreach ($pages as $item) {

            $page = Page::firstOrCreate(
                [
                    'slug' => $item['slug'],
                ]
            );

            foreach ($item['translations'] as $locale => $translation) {

                $page->translations()->updateOrCreate(
                    [
                        'locale' => $locale,
                    ],
                    [
                        'title' => $translation['title'],
                    ]
                );
            }
        }
    }
}
