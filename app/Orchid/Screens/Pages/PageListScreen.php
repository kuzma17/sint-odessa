<?php

namespace App\Orchid\Screens\Pages;

use App\Models\Page;
use App\Orchid\Screens\BaseListScreen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class PageListScreen extends BaseListScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {

        return [
            'pages' => Page::with(['attachments', 'translations'])->get(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Страницы';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [

        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('pages', [

                $this->columnImage(),

                TD::make('slug', 'Slug')->width(100),

                $this->columnTtitle()->width(100),

                $this->columnSubTtitle('SubTitle'),

                $this->columnActive(),

                TD::make('edit')
                    ->align(TD::ALIGN_CENTER)
                    ->render(function (Page $page) {

                        $route = match ($page->slug) {
                            'home' => 'platform.pages.home',
                            'about' => 'platform.pages.about',
                            'services' => 'platform.pages.services',
                            'contacts' => 'platform.pages.contacts',
                            'delivery' => 'platform.pages.delivery',
                            'faq' => 'platform.pages.faq',
                            'reviews' => 'platform.pages.reviews',
                            default => null,
                        };

                        if (!$route) {
                            return '-';
                        }

                        return Link::make('')
                            ->icon('pencil')
                            ->type(Color::SUCCESS)
                            ->route($route);
                    }),

            ])
        ];
    }

    protected function modelClass()
    {
        return Page::class;
    }

    protected function namePrefix(): string
    {
        return 'platform.pages';
    }
}
