<?php

namespace App\Orchid\Screens\Review;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Orchid\Fields\AvatarPicker;
use App\Orchid\Fields\GroupSelect;
use App\Orchid\Screens\BaseEditScreen;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Radio;
use Orchid\Screen\Fields\RadioButtons;
use Orchid\Screen\Fields\Range;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\View;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ReviewEditScreen extends BaseEditScreen
{
    public $review;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Review $review): iterable
    {
        $this->model = $review;
        return [
            'model' => $review,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->model->exists ? 'Edit Review' : 'Create Review';
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
            Layout::split([
                Layout::rows([
                    Select::make('model.locale')
                        ->options(['ru' => 'RU', 'ua' => 'UA'])
                        ->title('Locale'),
                    Select::make('model.rating')
                        ->options(['1' => '★', '2' => '★★', '3' => '★★★', '4' => '★★★★', '5' => '★★★★★'])
                        ->value(1)
                        ->title('Rating'),

                    Group::make([
                        Switcher::make('model.active')
                            ->title('on/off')
                            ->sendTrueOrFalse()
                            ->value(true),

                        Input::make('model.sort')
                            ->title('Sort')
                            ->type('number')
                            ->value(1),
                    ]),

                    GroupSelect::make('model.group'),

                ]),

                Layout::rows([
                    Input::make('model.author')
                        ->title('Name Author')
                        ->required(),

                    AvatarPicker::make('model.avatar')
                        ->title('Аватар')
                        ->avatars([
                            'avatar1.webp',
                            'avatar2.webp',
                            'avatar3.webp',
                            'avatar4.webp',
                            'avatar5.webp',
                            'avatar6.webp',
                            'avatar7.webp',
                            'avatar8.webp',
                            'avatar9.webp',
                            'avatar10.webp',
//                            'avatar11.webp',
//                            'avatar12.webp',
                        ]),

                    Input::make('model.location')
                        ->title('Location'),

                ]),

            ])->ratio('40/60'),
            Layout::rows([
                TextArea::make('model.content')
                    ->title('Content')
                    ->rows(10)
                    //->class('w-100')
                    ->required(),
            ])
        ];

    }

    public function save(ReviewRequest $request)
    {
        $data = $request->input('model');
        $this->saveModel($data);

        Toast::info('Reviews saved');

        return redirect()->route($this->nameList());
    }

    protected function namePrefix(): string
    {
        return 'platform.reviews';
    }
}
