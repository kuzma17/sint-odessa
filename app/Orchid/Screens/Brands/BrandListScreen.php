<?php

namespace App\Orchid\Screens\Brands;

use App\Models\Brand;
use App\Orchid\Screens\BaseListScreen;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class BrandListScreen extends BaseListScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'brands' => Brand::with(['attachments'])->paginate(10)
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Brand List';
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
            Layout::table('brands', [

                TD::make('id')->width(50),

                $this->columnImage(),

                TD::make('title')->width(200),

                TD::make('sort'),

                $this->columnActive(),

                $this->columnAction()
            ])
        ];
    }

    protected function modelClass()
    {
        return Brand::class;
    }

    protected function namePrefix(): string
    {
        return 'platform.brands';
    }
}
