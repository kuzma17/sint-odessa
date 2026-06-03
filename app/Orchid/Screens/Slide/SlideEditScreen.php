<?php

namespace App\Orchid\Screens\Slide;

use App\Http\Requests\SlideRequest;
use App\Models\Slide;
use App\Orchid\Screens\BaseEditScreen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class SlideEditScreen extends BaseEditScreen
{
   // public $slide;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Slide $slide): iterable
    {
        $this->model = $slide;
        $translations = $this->getTranslations();
        $attachment = $this->getAttachments();

        return [
            'model' => $slide,
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
        return $this->model->exists ? 'Edit Slide' : 'Create Slide';
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
            //Layout::columns([
                //Layout::split([
                Layout::rows([
                    Upload::make('image')
                        ->title('Image')
                        ->acceptedFiles('image/*')
                        ->maxFiles(1)
                        ->storage('public')
                        ->path('tmp')->horizontal(),

                    //Group::make([
                        Input::make('model.sort')
                            ->type('number')
                            ->title('Sort')
                            ->value(1)->horizontal(),
                        Switcher::make('model.active')
                            ->title('on/off')
                            ->sendTrueOrFalse()
                            ->value(true)->horizontal(),
                    //])

                ]),

                Layout::rows([
                    Input::make('translations.ru.title')->title('Title RU')->required()->horizontal(),
                    Input::make('translations.ua.title')->title('Title UA')->required()->horizontal(),
                    TextArea::make('translations.ru.description')
                        ->title('Description RU')
                        ->maxlength(255)
                        ->rows(4)->horizontal(),
                    TextArea::make('translations.ua.description')
                        ->title('Description UA')
                        ->maxlength(255)
                        ->rows(4)->horizontal(),
                ])
                    //])->ratio('40/60')
            //])
        ];
    }

    public function save(SlideRequest $request)
    {
        $data = $request->input('model');
        $translations = $request->input('translations');
        $image = $request->input('image');

        $this->saveModel($data);
        $this->saveTranslations($translations);

        if ($request->filled('image')) {
            $this->syncImage($image, 'slider');
        }

        Toast::info('Slider saved');

        return redirect()->route($this->nameList());
    }

    protected function namePrefix(): string
    {
        return 'platform.slides';
    }
}
