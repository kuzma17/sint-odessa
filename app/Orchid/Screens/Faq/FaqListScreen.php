<?php

namespace App\Orchid\Screens\Faq;

use App\Models\Faq;
use App\Orchid\Screens\BaseListScreen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class FaqListScreen extends BaseListScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'faqs' => Faq::with(['translations'])->paginate(10)
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'FaqList';
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
            Layout::table('faqs', [

                TD::make('id'),

                TD::make('question')->render(function ($faq) {
                    return optional(
                        $faq->translations->firstWhere('locale', 'ru')
                    )->question;
                }),

                $this->columnActive(),

                $this->columnAction()
            ]),

        ];
    }

    protected function modelClass()
    {
        return Faq::class;
    }

    protected function namePrefix(): string
    {
        return 'platform.faq';
    }
}
