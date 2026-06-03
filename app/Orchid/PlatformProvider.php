<?php

declare(strict_types=1);

namespace App\Orchid;

use App\Models\Brand;
use App\Models\Faq;
use App\Models\Review;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
//            Menu::make('Get Started')
//                ->icon('bs.book')
//                ->title('Navigation')
//                ->route(config('platform.index')),
//
//            Menu::make('Sample Screen')
//                ->icon('bs.collection')
//                ->route('platform.example')
//                ->badge(fn () => 6),
//
//            Menu::make('Form Elements')
//                ->icon('bs.card-list')
//                ->route('platform.example.fields')
//                ->active('*/examples/form/*'),
//
//            Menu::make('Layouts Overview')
//                ->icon('bs.window-sidebar')
//                ->route('platform.example.layouts'),
//
//            Menu::make('Grid System')
//                ->icon('bs.columns-gap')
//                ->route('platform.example.grid'),
//
//            Menu::make('Charts')
//                ->icon('bs.bar-chart')
//                ->route('platform.example.charts'),



            Menu::make('Страници')
                ->icon('bs.card-text')
                ->route('platform.pages')
                ->permission('platform.pages'),

            Menu::make('Услуги')
                ->icon('bs.tools')
                ->route('platform.services')
                ->permission('platform.services'),

            Menu::make('FAQ')
                ->icon('bs.question-circle')
                ->route('platform.faq')
                ->permission('platform.faq')
                ->badge(fn () => Faq::all()->count()),

            Menu::make('Отзывы')
                ->icon('bs.chat-left-text')
                ->route('platform.reviews')
                ->permission('platform.reviews')
                ->badge(fn () => Review::all()->count()),

            Menu::make('Слайдер')
                ->icon('bs.card-image')
                ->route('platform.slides')
                ->permission('platform.slider'),

            Menu::make('Офисы')
                ->icon('bs.houses')
                ->route('platform.offices')
                ->permission('platform.offices'),

            Menu::make('Бренды')
                ->icon('bs.bookmark-star')
                ->route('platform.brands')
                ->permission('platform.brands'),

            Menu::make('Settings')
                ->icon('bs.gear')
                ->route('platform.settings')
                ->permission('platform.settings'),



//            Menu::make('Content')
//                ->icon('folder')
//
//                ->list([
//                    Menu::make('FAQ')
//                        ->route('platform.faqs')
//                        ->icon('bs.question-circle'),
//
//                    Menu::make('Reviews')
//                        ->route('platform.reviews')
//                        ->icon('bubble'),
//
//                    Menu::make('Services')
//                        ->route('platform.services')
//                        ->icon('briefcase'),
//                ]),




//            Menu::make('Cards')
//                ->icon('bs.card-text')
//                ->route('platform.example.cards')
//                ->divider(),

            Menu::make(__('Users'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access Controls')),

            Menu::make(__('Roles'))
                ->icon('bs.shield')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->divider(),

//            Menu::make('Documentation')
//                ->title('Docs')
//                ->icon('bs.box-arrow-up-right')
//                ->url('https://orchid.software/en/docs')
//                ->target('_blank'),
//
//            Menu::make('Changelog')
//                ->icon('bs.box-arrow-up-right')
//                ->url('https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md')
//                ->target('_blank')
//                ->badge(fn () => Dashboard::version(), Color::DARK),
        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),

            ItemPermission::group('Settings')
                ->addPermission('platform.settings', 'Settings'),

            ItemPermission::group('Pages')
                ->addPermission('platform.pages', 'Pages')
                ->addPermission('platform.pages.edit', 'Pages edit'),

            ItemPermission::group('Services')
                ->addPermission('platform.services', 'Services')
                ->addPermission('platform.services.create', 'Services create')
                ->addPermission('platform.services.edit', 'Services edit')
                ->addPermission('platform.services.delete', 'Services delete'),

            ItemPermission::group('Faq')
                ->addPermission('platform.faq', 'FAQ')
                ->addPermission('platform.faq.create', 'FAQ create')
                ->addPermission('platform.faq.edit', 'FAQ edit')
                ->addPermission('platform.faq.delete', 'FAQ delete'),

            ItemPermission::group('Reviews')
                ->addPermission('platform.reviews', 'Reviews')
                ->addPermission('platform.reviews.create', 'Reviews create')
                ->addPermission('platform.reviews.edit', 'Reviews edit')
                ->addPermission('platform.reviews.delete', 'Reviews delete'),

            ItemPermission::group('Slides')
                ->addPermission('platform.slides', 'Slides')
                ->addPermission('platform.slides.create', 'Slides create')
                ->addPermission('platform.slides.edit', 'Slides edit')
                ->addPermission('platform.slides.delete', 'Slides delete'),

            ItemPermission::group('Offices')
                ->addPermission('platform.offices', 'Offices')
                ->addPermission('platform.offices.create', 'Offices create')
                ->addPermission('platform.offices.edit', 'Offices edit')
                ->addPermission('platform.offices.delete', 'Offices delete'),

            ItemPermission::group('Brands')
                ->addPermission('platform.brands', 'Brands')
                ->addPermission('platform.brands.create', 'Brands create')
                ->addPermission('platform.brands.edit', 'Brands edit')
                ->addPermission('platform.brands.delete', 'Brands delete'),


        ];
    }
}
