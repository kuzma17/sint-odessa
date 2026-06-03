<?php

namespace App\Orchid\Screens\Brands;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Orchid\Fields\GroupSelect;
use App\Orchid\Screens\BaseEditScreen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class BrandEditScreen extends BaseEditScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Brand $brand): iterable
    {
        $this->model = $brand;
        $attachment = $this->getAttachments();

        return [
            'model' => $brand,
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
        return 'Brand Edit';
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
            //Layout::split([
            Layout::rows([
                Upload::make('image')
                    ->title('Image (обязательно для заполнения)')
                    ->acceptedFiles('image/*')
                    ->maxFiles(1)
                    ->storage('public')
                    ->path('tmp')->horizontal(),

                Input::make('model.sort')
                    ->type('number')
                    ->title('Sort')
                    ->value(1)->horizontal(),
                Switcher::make('model.active')
                    ->title('on/off')
                    ->sendTrueOrFalse()
                    ->value(true)->horizontal(),
            ]),
                Layout::rows([
                    Input::make('model.title')->title('Title')->required()->horizontal(),
                    GroupSelect::make('model.group'),
                ])

               // ])->ratio('40/60')
        ];
    }

    public function save(BrandRequest $request)
    {
        $data = $request->input('model');
        $image = $request->input('image');

        $this->saveModel($data);

        if ($request->filled('image')) {
            $this->syncImage($image, 'brand');
        }

        Toast::info('Brand saved');

        return redirect()->route($this->nameList());
    }

    protected function namePrefix(): string
    {
        return 'platform.brands';
    }
}
