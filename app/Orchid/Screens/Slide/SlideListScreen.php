<?php

namespace App\Orchid\Screens\Slide;

use App\Http\Requests\SlideRequest;
use App\Models\Slide;

use App\Orchid\Screens\BaseListScreen;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class SlideListScreen extends BaseListScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'slides' => Slide::with(['translations', 'attachments'])
                ->paginate(10),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Сдайдер';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return $this->createButton();
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('slides', [

                TD::make('id')->width(50),

                $this->columnImage(),

                $this->columnTtitle(),

                TD::make('sort'),

                $this->columnActive(),

                $this->columnAction()
            ])
        ];
    }

    protected function modelClass()
    {
        return Slide::class;
    }

    protected function namePrefix(): string
    {
        return 'platform.slides';
    }
}
