<?php

declare(strict_types=1);

use App\Orchid\Screens\Examples\ExampleActionsScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleGridScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Example Screen'));

Route::screen('/examples/form/fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('/examples/form/advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');
Route::screen('/examples/form/editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('/examples/form/actions', ExampleActionsScreen::class)->name('platform.example.actions');

Route::screen('/examples/layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('/examples/grid', ExampleGridScreen::class)->name('platform.example.grid');
Route::screen('/examples/charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('/examples/cards', ExampleCardsScreen::class)->name('platform.example.cards');

// Route::screen('idea', Idea::class, 'platform.screens.idea');

//////////////////====================================/////////////

// Faq
Route::screen('faq', \App\Orchid\Screens\Faq\FaqListScreen::class)->name('platform.faq');
Route::screen('faq/create', \App\Orchid\Screens\Faq\FaqEditScreen::class)->name('platform.faq.create');
Route::screen('faq/{faq}/edit', \App\Orchid\Screens\Faq\FaqEditScreen::class)->name('platform.faq.edit');

// Sliders
Route::screen('slides', \App\Orchid\Screens\Slide\SlideListScreen::class)->name('platform.slides');
Route::screen('slides/create', \App\Orchid\Screens\Slide\SlideEditScreen::class)->name('platform.slides.create');
Route::screen('slides/{slide}/edit', \App\Orchid\Screens\Slide\SlideEditScreen::class)->name('platform.slides.edit');

// Services
Route::screen('services', \App\Orchid\Screens\Service\ServiceListScreen::class)->name('platform.services');
Route::screen('services/create', \App\Orchid\Screens\Service\ServiceEditScreen::class)->name('platform.services.create');
Route::screen('services/{service}/edit', \App\Orchid\Screens\Service\ServiceEditScreen::class)->name('platform.services.edit');

// Reviews
Route::screen('reviews', \App\Orchid\Screens\Review\ReviewListScreen::class)->name('platform.reviews');
Route::screen('reviews/create', \App\Orchid\Screens\Review\ReviewEditScreen::class)->name('platform.reviews.create');
Route::screen('reviews/{review}/edit', \App\Orchid\Screens\Review\ReviewEditScreen::class)->name('platform.reviews.edit');

// Offices
Route::screen('offices', \App\Orchid\Screens\Offices\OfficeListScreen::class)->name('platform.offices');
Route::screen('offices/create', \App\Orchid\Screens\Offices\OfficeEditScreen::class)->name('platform.offices.create');
Route::screen('offices/{office}/edit', \App\Orchid\Screens\Offices\OfficeEditScreen::class)->name('platform.offices.edit');

// Pages
Route::screen('pages', \App\Orchid\Screens\Pages\PageListScreen::class)->name('platform.pages');
Route::screen('pages/home', \App\Orchid\Screens\Pages\HomePageEditScreen::class)->name('platform.pages.home');
Route::screen('pages/about', \App\Orchid\Screens\Pages\AboutPageEditScreen::class)->name('platform.pages.about');
Route::screen('pages/contacts', \App\Orchid\Screens\Pages\ContactsPageEditScreen::class)->name('platform.pages.contacts');
Route::screen('pages/services', \App\Orchid\Screens\Pages\ServicesPageEditScreen::class)->name('platform.pages.services');
Route::screen('pages/delivery', \App\Orchid\Screens\Pages\DeliveryPageEditScreen::class)->name('platform.pages.delivery');
Route::screen('pages/faq', \App\Orchid\Screens\Pages\FaqPageEditScreen::class)->name('platform.pages.faq');
Route::screen('pages/reviews', \App\Orchid\Screens\Pages\ReviewsPageEditScreen::class)->name('platform.pages.reviews');

// Brand
Route::screen('brands', \App\Orchid\Screens\Brands\BrandListScreen::class)->name('platform.brands');
Route::screen('brands/create', \App\Orchid\Screens\Brands\BrandEditScreen::class)->name('platform.brands.create');
Route::screen('brands/{brand}/edit', \App\Orchid\Screens\Brands\BrandEditScreen::class)->name('platform.brands.edit');

// Settings
Route::screen('settings', \App\Orchid\Screens\Settings\SettingsEditScreen::class)->name('platform.settings');