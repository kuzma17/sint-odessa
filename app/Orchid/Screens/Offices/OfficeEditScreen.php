<?php

namespace App\Orchid\Screens\Offices;

use App\Http\Requests\OfficeRequest;
use App\Models\Office;
use App\Orchid\Fields\PhoneRepeater;
use App\Orchid\Screens\BaseEditScreen;
use App\Orchid\Traits\HasPhones;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Map;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class OfficeEditScreen extends BaseEditScreen
{
    use HasPhones;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Office $office): iterable
    {
        $this->model = $office;
        $translations = $this->getTranslations();
        $attachment = $this->getAttachments();

        return [
            'model' => $office,
            'translations' => $translations,
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
        return 'Редактирование офиса';
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

                            Input::make('model.id')->hidden(),

                            Upload::make('image')
                                ->title('Основная картинка')
                                ->acceptedFiles('image/*')
                                ->maxFiles(1)
                                ->storage('public')
                                ->path('tmp')->horizontal(),

                            Input::make('model.sort')
                                ->type('number')
                                ->title('Sort')
                                ->value(1)->horizontal(),

                            Switcher::make('model.active')
                                ->sendTrueOrFalse()
                                ->title('On/Off')
                                ->value(true)->horizontal(),

                            PhoneRepeater::make('model.phones')
                                ->title('Телефоны')
                                ->required()->horizontal(),


                        ]),

                        Layout::rows([
                            Input::make('translations.ru.title')
                                ->title('Title RU')
                                ->required()->horizontal(),
                            Input::make('translations.ua.title')
                                ->title('Title ua')
                                ->required()->horizontal(),

                            TextArea::make('translations.ru.subtitle')
                                ->title('Sub Title RU')
                                ->max(255)
                                ->rows(4)->horizontal(),
                            TextArea::make('translations.ua.subtitle')
                                ->title('SubTitle ua')
                                ->max(255)
                                ->rows(4)->horizontal(),

                            Input::make('translations.ru.address')
                                ->title('Address RU')
                                ->required()->horizontal(),
                            Input::make('translations.ua.address')
                                ->title('Address ua')
                                ->required()->horizontal(),
                        ]),

                ],

                'Map' => [
                    Layout::rows([
                        Map::make('model.map')
                            ->title('Object on the map')
                            ->zoom(13)
                            ->height('400px')
                            ->help('Enter the coordinates, or use the search'),
                    ])
                ]

            ])
        ];
    }

    public function save(OfficeRequest $request)
    {
        $data = $request->input('model');

        $data['phones'] = $this->normalizePhones(
            $data['phones'] ?? []
        );

        $translations = $request->input('translations');
        $image = $request->input('image');


        $this->saveModel($data);
        $this->saveTranslations($translations);

        if ($request->filled('image')) {
            $this->syncImage($image, 'office');
        }

        Toast::info('Office saved');

        return redirect()->route($this->nameList());
    }

    protected function namePrefix(): string
    {
        return 'platform.offices';
    }
}
