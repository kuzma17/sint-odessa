<?php

namespace App\Orchid\Screens\Faq;

use App\Http\Requests\FaqRequest;
use App\Models\Faq;
use App\Orchid\Fields\GroupSelect;
use App\Orchid\Screens\BaseEditScreen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class FaqEditScreen extends BaseEditScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Faq $faq): iterable
    {
        $this->model = $faq;
        $translations = $this->getTranslations();

        return [
            'model' => $faq,
            'translations' => $translations,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'FaqEdit';
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
                Layout::rows([

                    GroupSelect::make('model.group'),

                    Input::make('model.sort')
                        ->title('Sort')
                        ->type('number')
                        ->value(1)->horizontal(),

                    Switcher::make('model.active')
                        ->title('Active')
                        ->sendTrueOrFalse()
                        ->value(true)->horizontal(),

                ]),
                Layout::rows([
                    Input::make('translations.ru.question')
                        ->title('Question (RU)')
                        ->required()->horizontal(),
                    Input::make('translations.ua.question')
                        ->title('Question (UA)')
                        ->required()->horizontal(),

                    TextArea::make('translations.ru.answer')
                        ->title('Answer (RU)')
                        ->rows(3)
                        ->required()->horizontal(),
                    TextArea::make('translations.ua.answer')
                        ->title('Answer (UA)')
                        ->rows(3)
                        ->required()->horizontal(),
                ])
        ];
    }

    public function save(FaqRequest $request)
    {
        $data = $request->input('model');
        $translations = $request->input('translations');

        $this->saveModel($data);
        $this->saveTranslations($translations);

        Toast::info('Faq saved');

        return redirect()->route($this->nameList());
    }

    protected function namePrefix(): string
    {
        return 'platform.faq';
    }
}
