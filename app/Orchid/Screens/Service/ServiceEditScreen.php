<?php

namespace App\Orchid\Screens\Service;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Orchid\Fields\Repeater;
use App\Orchid\Layouts\Page\SeoLayout;
use App\Orchid\Screens\BaseEditScreen;
use Illuminate\Http\Request;
use Nakipelo\Orchid\CKEditor\CKEditor;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ServiceEditScreen extends BaseEditScreen
{

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Service $service): iterable
    {
        $this->model = $service;
        $translations = $this->getTranslations();
        $attachment_card = $this->getAttachments('card');
        $attachment = $this->getAttachments('content');
        return [
            'model' => $service,
            'translations' => $translations,
            'image' => $attachment,
            'image_card' => $attachment_card,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->model->exists ? 'Edit Service' : 'Create Service';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return $this->getButtons();
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
                        Upload::make('image_card')
                            ->groups('card')
                            ->title('Card image')
                            ->acceptedFiles('image/*')
                            ->maxFiles(1)
                            ->storage('public')
                            ->path('tmp')->horizontal(),

                        Input::make('model.slug')
                            ->title('Slug')
                            ->required()->horizontal(),

                        Switcher::make('model.active')
                            ->title('On/Off')
                            ->sendTrueOrFalse()
                            ->value(true)->horizontal(),
                        Input::make('model.sort')
                            ->type('number')
                            ->title('Сортировка')
                            ->value(1)->horizontal(),
                        ]),


                        Layout::rows([
                            Input::make('translations.ru.title')
                                ->title('Title (RU)')
                                ->required()->horizontal(),
                            Input::make('translations.ua.title')
                                ->title('Title (UA)')
                                ->required()->horizontal(),

                            TextArea::make('translations.ru.description')
                                ->title('Description (RU)')
                                ->maxlength('255')
                                ->rows(4)
                                ->required()->horizontal(),
                            TextArea::make('translations.ua.description')
                                ->title('Description (UA)')
                                ->maxlength('255')
                                ->rows(4)
                                ->required()->horizontal(),
                        ]),

                ],

                'Content' => [
                        Layout::rows([
                            Upload::make('image')
                                ->groups('content')
                                ->title('Image')
                                ->acceptedFiles('image/*')
                                ->maxFiles(1)
                                ->storage('public')
                                ->path('tmp')->horizontal(),

                        ]),
                        Layout::rows([
                            TextArea::make('translations.ua.subtitle')
                                ->title('Subtitle (UA)')
                                ->maxlength('255')
                                ->rows(4)
                                ->horizontal(),
                            TextArea::make('translations.ua.subtitle')
                                ->title('Subtitle (UA)')
                                ->maxlength('255')
                                ->rows(4)
                                ->horizontal(),
                        ]),

                    Layout::rows([
                        CKEditor::make('translations.ru.content')
                            ->title('Контент RU')
                            ->required()->horizontal(),
                        CKEditor::make('translations.ua.content')
                            ->title('Контент UA')
                            ->required()->horizontal(),
                    ])
                ],

                $this->getTitleDevices() => [
                    Layout::rows([
                        Repeater::make('model.blocks.devices')
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

                $this->getTitleProblems() => [
                    Layout::rows([
                        Repeater::make('model.blocks.problems')
                            ->fields([
                                [
                                    'key' => 'title',
                                    'label' => 'Title',
                                    'translatable' => true,
                                ],
                            ]),
                    ])

                ],

                $this->getTitleSteps() => [
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

                $this->getTitlePrice() => [
                    Layout::rows([
                        Repeater::make('model.blocks.price')
                            ->fields([
                                [
                                    'key' => 'title',
                                    'label' => 'Title',
                                    'translatable' => true,
                                ],
                                [
                                    'key' => 'price',
                                    'label' => 'Price',
                                    'translatable' => true,
                                ],
                            ]),
                    ])

                ],

                'SEO' => SeoLayout::make(),
            ]),
        ];
    }

    protected function checkTypeCartridgeRefill()
    {
        if ($this->model && $this->model->slug == 'cartridge-refill'){
            return true;
        }
        return false;
    }

    protected function getTitleDevices()
    {
        if ($this->checkTypeCartridgeRefill())
        {
            return 'Какие картриджи заправляем';
        }

        return 'Какие устройства мы ремонтируем';
    }

    protected function getTitleSteps()
    {
        if ($this->checkTypeCartridgeRefill())
        {
            return 'Как выполняется заправка';
        }

        return 'Как проходит ремонт';
    }

    protected function getTitleProblems()
    {
        if ($this->checkTypeCartridgeRefill())
        {
            return 'Когда требуется заправка';
        }

        return 'Типичные неисправности';
    }

    protected function getTitlePrice()
    {
        if ($this->checkTypeCartridgeRefill())
        {
            return 'Стоимость заправки';
        }

        return 'Стоимость ремонта';
    }

    public function save(Request $request)
    {
        $data = $request->input('model');
        $translations = $request->input('translations');
        $image = $request->input('image');
        $image_card = $request->input('image_card');

        $this->saveModel($data);
        $this->saveTranslations($translations);

        if ($request->filled('image_card')) {
            $this->syncImage($image_card, 'card', 'card'); // group обязятельно указываем
        }

        if ($request->filled('image')) {
            $this->syncImage($image, 'page', 'content'); // group обязятельно указываем
        }

        Toast::info('Service saved');

        return redirect()->route($this->nameList());
    }

    protected function namePrefix(): string
    {
        return 'platform.services';
    }
}
