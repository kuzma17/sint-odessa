<?php

namespace App\Orchid\Screens\Pages;

use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Orchid\Layouts\Blocks\AdvantagesLayout;
use App\Orchid\Layouts\Page\ContentLayout;
use App\Orchid\Layouts\Page\SeoLayout;
use App\Orchid\Layouts\Page\TitleLayout;
use App\Orchid\Screens\BaseEditScreen;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ServicesPageEditScreen extends BaseEditScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $model = Page::where('slug', 'services')->first();
        $this->model = $model;
        $attachment = $this->getAttachments();

        return [
            'page' => $model,
            'translations' => $this->getTranslations(),
            'image' => $attachment,
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
                'Main' => [
                    TitleLayout::class,
                    Layout::accordion([
                        'Content' => ContentLayout::class
                    ])->open(false)
                ],

                'Почему выбирают нас' => AdvantagesLayout::class,

                'SEO & Social' => SeoLayout::make(),

                ])
        ];
    }

    public function save(PageRequest $request)
    {
        $data = $request->input('model');
        $translations = $request->input('translations');

        $this->saveModel($data);
        $this->saveTranslations($translations);

        Toast::info('Page saved');

        return redirect()->route($this->nameList());

    }

    protected function namePrefix(): string
    {
        return 'platform.pages';
    }
}
