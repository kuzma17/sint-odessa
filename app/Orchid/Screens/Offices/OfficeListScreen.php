<?php

namespace App\Orchid\Screens\Offices;

use App\Models\Office;
use App\Orchid\Screens\BaseListScreen;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class OfficeListScreen extends BaseListScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'offices' => Office::get()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Offices';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return $this->createButton('Add Office');
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('offices', [
                $this->columnImage(),

                $this->columnTtitle(),

                TD::make('address', 'Адрес')
                    ->render(fn($office) =>
                        $office->translation('ru')->address ?? '-'
                    ),

                $this->columnActive(),

                TD::make('sort', 'Сортировка'),

                $this->columnAction()
            ]),
        ];
    }

    protected function modelClass()
    {
        return Office::class;
    }

    protected function namePrefix(): string
    {
        return 'platform.offices';
    }


}
