<?php

namespace App\Orchid\Screens\Pages;

use App\Models\Page;
use App\Orchid\Fields\BlockField;
use App\Orchid\Fields\BlockFields;
use App\Orchid\Fields\Repeater;
use App\Orchid\Layouts\Blocks\AdvantagesLayout;
use App\Orchid\Layouts\Page\ContentLayout;
use App\Orchid\Layouts\Page\SeoLayout;
use App\Orchid\Layouts\Page\TitleLayout;
use App\Orchid\Screens\BaseEditScreen;
use App\Orchid\Traits\HasBlockChecks;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Block;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class HomePageEditScreen extends BaseEditScreen
{
    use HasBlockChecks;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Page $page): iterable
    {
        $model = Page::where('slug', 'home')->first();
        $this->model = $model;
        $attachment = $this->getAttachments();

        return [
            'model' => $model,
            'translations' => $this->getTranslations(),
            'image' => $attachment,

            'faq_show' => false,
            'count_faq' => null,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Главная';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return $this->getButtons(false);
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
                    TitleLayout::class,
                    Layout::rows([
                        ...BlockFields::make('brands', 'Brands', 8),
                        ...BlockFields::make('faq', 'FAQ', 3),
                        ...BlockFields::make('reviews', 'Reviews', 3),
                    ]),

                    Layout::accordion([
                        'Content' => ContentLayout::class
                        ])->open(false)
                ],

                'Почему выбирают нас' => Layout::rows([
                        Repeater::make('model.blocks.advantages-digital')
                            ->fields([
                                [
                                    'key' => 'title',
                                    'label' => 'Короткое название',
                                    'translatable' => true,
                                ],
                                [
                                    'key' => 'value',
                                    'label' => 'Макс. значение',
                                ],
                                [
                                    'key' => 'until',
                                    'label' => 'Единица измерения',
                                    'translatable' => true,
                                ]
                            ]),
                    ]),

                'Как мы работаем' => Layout::rows([
                        Repeater::make('model.blocks.workflow')
                            ->fields([
                                [
                                    'key' => 'title',
                                    'label' => 'Title',
                                    'translatable' => true,
                                ],
                                [
                                    'key' => 'description',
                                    'label' => 'Description',
                                    'translatable' => true,
                                ],

                            ]),
                    ]),

                'SEO' => SeoLayout::make(),

            ]),
        ];
    }

    public function save(Request $request)
    {
        $data = $request->input('model');
        $translations = $request->input('translations');
        $image = $request->input('image');

        $this->saveModel($data);
        $this->saveTranslations($translations);

        if ($request->filled('image')) {
            $this->syncImage($image, 'page');
        }

        $messages = $this->checkGroupBlock($data, 'home');

        if (!empty($messages)) {
            Alert::view('platform/notifications/alert', Color::WARNING, [
                'messages' => $messages,
            ]);
        }

        Toast::info('Page saved');

        if (empty($messages)){
            return redirect()->route($this->nameList());
        }
    }

    protected function namePrefix(): string
    {
        return 'platform.pages';
    }
}
