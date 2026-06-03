<?php

namespace App\Orchid\Screens\Service;

use App\Models\Service;
use App\Orchid\Screens\BaseListScreen;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class ServiceListScreen extends BaseListScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'services' => Service::with(['translations', 'attachments'])->paginate(10),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Service List';
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
            Layout::table('services', [
                TD::make('id'),
                $this->columnImage('Image'),
                $this->columnTtitle(),
                TD::make('slug'),
                $this->columnActive(),
                $this->columnAction()
            ]),
        ];
    }


    protected function modelClass()
    {
        return Service::class;
    }


    protected function namePrefix(): string
    {
        return 'platform.services';
    }
}
