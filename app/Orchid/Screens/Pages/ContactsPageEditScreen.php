<?php

namespace App\Orchid\Screens\Pages;

use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Orchid\Fields\Repeater;
use App\Orchid\Layouts\Page\ContentLayout;
use App\Orchid\Layouts\Page\SeoLayout;
use App\Orchid\Layouts\Page\TitleLayout;
use App\Orchid\Layouts\Role\RoleEditLayout;
use App\Orchid\Screens\BaseEditScreen;

use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ContactsPageEditScreen extends BaseEditScreen
{
    public $page;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $model = Page::where('slug', 'contacts')->first();
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
        return 'Контакты';
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
                'Main' => [
                    TitleLayout::class,
                    Layout::accordion([
                        'Content' => ContentLayout::class
                    ])->open(false)
                ],

                'SEO & Social' => SeoLayout::make(),
            ]),
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
