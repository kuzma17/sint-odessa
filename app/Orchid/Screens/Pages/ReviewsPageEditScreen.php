<?php

namespace App\Orchid\Screens\Pages;

use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Orchid\Layouts\Page\SeoLayout;
use App\Orchid\Layouts\Page\TitleLayout;
use App\Orchid\Screens\BaseEditScreen;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ReviewsPageEditScreen extends BaseEditScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $model = Page::where('slug', 'reviews')->first();
        $this->model = $model;

        return [
            'translations' => $this->getTranslations(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Отзывы';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return $this->getButtons(false);
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::tabs([
                'Main' => TitleLayout::class,
                'SEO & Social' => SeoLayout::make(),
                ])
            ];
    }

    public function save(PageRequest $request)
    {
        $translations = $request->input('translations');

        $this->saveTranslations($translations);

        Toast::info('Page saved');

        return redirect()->route($this->nameList());
    }

    protected function namePrefix(): string
    {
        return 'platform.pages';
    }
}
