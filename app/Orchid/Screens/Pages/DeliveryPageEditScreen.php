<?php

namespace App\Orchid\Screens\Pages;

use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Orchid\Fields\Repeater;
use App\Orchid\Layouts\Blocks\AdvantagesLayout;
use App\Orchid\Layouts\Page\ContentLayout;
use App\Orchid\Layouts\Page\SeoLayout;
use App\Orchid\Layouts\Page\TitleLayout;
use App\Orchid\Screens\BaseEditScreen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class DeliveryPageEditScreen extends BaseEditScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $model = Page::where('slug', 'delivery')->first();
        $this->model = $model;
        $attachment = $this->getAttachments();

        return [
            'model' => $model,
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
        return 'Доставка';
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
                    Layout::rows([
                        Upload::make('image')
                            ->title('Основная картинка')
                            ->acceptedFiles('image/*')
                            ->maxFiles(1)
                            ->storage('public')
                            ->path('tmp')->horizontal(),
                        ]),

                    TitleLayout::class,
                    ContentLayout::class
                ],

                'Как работает доставка' => [
                    Layout::rows([
                        Repeater::make('model.blocks.workflow')
                            ->fields([
                                [
                                    'key' => 'title',
                                    'label' => 'Title',
                                    'translatable' => true,
                                ],
                                [
                                    'key' => 'description',
                                    'label' => 'Description',
                                    'translatable' => true,
                                ],

                            ]),

                    ])

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
        $image = $request->input('image');

        $this->saveModel($data);
        $this->saveTranslations($translations);

        if ($request->filled('image')) {
            $this->syncImage($image, 'page');
        }

        Toast::info('Page saved');

        return redirect()->route($this->nameList());
    }

    protected function namePrefix(): string
    {
        return 'platform.pages';
    }
}
