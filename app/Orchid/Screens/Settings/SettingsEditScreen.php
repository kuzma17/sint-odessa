<?php

namespace App\Orchid\Screens\Settings;


use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use App\Orchid\Fields\PhoneRepeater;
use App\Orchid\Screens\BaseEditScreen;
use App\Orchid\Traits\HasPhones;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class SettingsEditScreen extends BaseEditScreen
{
    use HasPhones;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Setting $setting): iterable
    {
        $setting = Setting::find(1);
        $this->model = $setting;
        $attachment_og = $this->getAttachments('og');
        $attachment_logo = $this->getAttachments('logo');
        $attachment_logo_footer = $this->getAttachments('logo_footer');
        return [
            'model' => $setting,
            'image_og' => $attachment_og,
            'image_logo' => $attachment_logo,
            'image_logo_footer' => $attachment_logo_footer,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Settings Edit';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Save')
                ->name('save')
                ->icon('bs.check')
                ->method('save')
                ->type(Color::SUCCESS),
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
            Layout::tabs([
                'Main' => [
                    Layout::rows([
                        Upload::make('image_logo')
                            ->title('Logo Image')
                            ->acceptedFiles('image/*')
                            ->maxFiles(1)
                            ->storage('public')
                            ->path('tmp')
                            ->groups('logo')
                            ->horizontal(),

                        Upload::make('image_logo_footer')
                            ->title('Logo Footer')
                            ->acceptedFiles('image/*')
                            ->maxFiles(1)
                            ->storage('public')
                            ->path('tmp')
                            ->groups('logo_footer')
                            ->horizontal()->help('Изображение должно быть черно-белым на прозрачном фоне согласно текущего дизайна.'),

                        Input::make('model.data.title.ru')
                            ->type('text')
                            ->max(255)
                            ->horizontal()
                            ->required()
                            ->title('Название сайта RU'),
                        Input::make('model.data.title.ua')
                            ->type('text')
                            ->max(255)
                            ->horizontal()
                            ->required()
                            ->title('Название сайта UA'),

                        TextArea::make('model.data.description.ru')
                            ->type('text')
                            ->max(255)
                            ->horizontal()
                            ->required()
                            ->title('Description site RU'),

                        TextArea::make('model.data.description.ua')
                            ->type('text')
                            ->max(255)
                            ->horizontal()
                            ->required()
                            ->title('Description site UA'),

                        Input::make('model.data.city.ru')
                            ->type('text')
                            ->max(255)
                            ->horizontal()
                            ->required()
                            ->title('Город RU'),

                        Input::make('model.data.city.ua')
                            ->type('text')
                            ->max(255)
                            ->horizontal()
                            ->required()
                            ->title('Город UA'),

                        Input::make('model.data.address.ru')
                            ->type('text')
                            ->max(255)
                            ->horizontal()
                            ->required()
                            ->title('Адрес RU'),

                        Input::make('model.data.address.ua')
                            ->type('text')
                            ->max(255)
                            ->horizontal()
                            ->required()
                            ->title('Адрес UA'),

                        PhoneRepeater::make('model.data.phones')
                            ->title('Телефоны')
                            ->horizontal()
                            ->required(),

                        Input::make('model.data.email')
                            ->type('email')
                            ->max(255)
                            ->horizontal()
                            ->required()
                            ->title('📧 Email'),

                        Input::make('model.data.viber')
                            ->type('text')
                            ->max(255)
                            ->horizontal()
                            ->title('Viber')
                            ->help('Пример: viber://chat?number=+380999999999'),

                        Input::make('model.data.telegram')
                            ->type('text')
                            ->max(255)
                            ->horizontal()
                            ->title('Telegram')
                            ->help('Пример: https://t.me/+380999999999'),

                        Input::make('model.data.instagram')
                            ->type('text')
                            ->max(255)
                            ->horizontal()
                            ->title('Адрес страници Instagram')
                            ->help('Пример: https://www.instagram.com/company_name'),

                        Input::make('model.data.facebook')
                            ->type('text')
                            ->max(255)
                            ->horizontal()
                            ->title('Адрес страници Facebook'),

                        Input::make('model.data.working_hours_week')
                            ->type('text')
                            ->max(255)
                            ->horizontal()
                            ->required()
                            ->title('Время работы пн-пт')
                            ->placeholder('09:00 – 18:00'),

                        Input::make('model.data.working_hours_sat')
                            ->type('text')
                            ->max(255)
                            ->horizontal()
                            ->required()
                            ->title('Время работы сб')
                            ->placeholder('10:00 – 16:00'),

                        Input::make('model.data.admin_email')
                            ->type('email')
                            ->max(255)
                            ->horizontal()
                            //->required()
                            ->title('Админ Email'),

                        Input::make('model.data.telegram_chat_id')
                            ->type('text')
                            ->max(255)
                            ->horizontal()
                            // ->required()
                            ->title('Telegram chat'),

                    ])
                ],

                'SEO & Social' => [
                    Layout::rows([
                        Input::make('model.data.seo_title.ru')->title('SEO Title RU')->horizontal(),
                        Input::make('model.data.seo_title.ua')->title('SEO Title UA')->horizontal(),

                        TextArea::make('model.data.seo_description.ru')->title('SEO Description RU')->rows(5)->horizontal(),
                        TextArea::make('model.data.seo_description.ua')->title('SEO Description UA')->rows(5)->horizontal(),

                        TextArea::make('model.data.seo_keywords.ru')->title('SEO Keywords RU')->rows(5)->horizontal(),
                        TextArea::make('model.data.seo_keywords.ua')->title('SEO Keywords UA')->rows(5)->horizontal(),
                    ]),

                    Layout::rows([

                        Upload::make('image_og')
                            ->title('OG картинка')
                            ->acceptedFiles('image/*')
                            ->maxFiles(1)
                            ->storage('public')
                            ->path('tmp')
                            ->groups('og')
                            ->horizontal(),

                        Input::make('model.data.og_title.ru')->title('OG Title RU')->horizontal(),
                        Input::make('model.data.og_title.ua')->title('OG Title UA')->horizontal(),

                        TextArea::make('model.data.og_description.ru')->title('OG Description RU')->rows(5)->horizontal(),
                        TextArea::make('model.data.og_description.ua')->title('OG Description UA')->rows(5)->horizontal(),
                        ])
                ]



            ])

        ];
    }

    public function save(SettingRequest $request)
    {
        $data = $request->input('model');
        $image_og = $request->input('image_og');
        $image_logo  = $request->input('image_logo');
        $image_logo_footer = $request->input('image_logo_footer');

        $data['data']['phones'] = $this->normalizePhones(
            $data['data']['phones'] ?? []
        );

        $data['data'] = $this->cleanData($data['data']);

        $this->saveModel($data);

        if ($request->filled('image_og')) {
            $this->syncImage($image_og, 'og', 'og'); // group обязятельно указываем
        }
        if ($request->filled('image_logo')) {
            $this->syncImage($image_logo, 'logo', 'logo'); // group обязятельно указываем
        }
        if ($request->filled('image_logo_footer')) {
            $this->syncImage($image_logo_footer, 'logo_footer', 'logo_footer'); // group обязятельно указываем
        }

        Setting::clearCache();

        Toast::info('Reviews saved');

    }

    private function cleanData($data)
    {
        if (is_array($data)) {

            foreach ($data as $key => $value) {

                if (is_array($value)) {
                    $data[$key] = $this->cleanData($value);

                    // убрать пустые multilingual структуры
                    if (array_filter($data[$key], fn($v) => $v !== null && $v !== '') === []) {
                        unset($data[$key]);
                    }
                }

                if ($value === '' || $value === null) {
                    unset($data[$key]);
                }
            }
        }

        return $data;
    }

    public function permission(): ?iterable
    {
        return [
            'platform.settings',
        ];
    }


    protected function namePrefix(): string
    {
        return 'platform.settings';
    }

}
