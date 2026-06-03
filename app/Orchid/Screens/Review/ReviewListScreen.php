<?php

namespace App\Orchid\Screens\Review;

use App\Models\Review;
use App\Orchid\Screens\BaseListScreen;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ReviewListScreen extends BaseListScreen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Review $review): iterable
    {
        return [
            'reviews' => Review::paginate(10),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Отзывы';
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
            Layout::table('reviews', [
                TD::make('id'),

                TD::make('locale')->render(fn ($review) =>
                    $review->locale ?? ''
                ),

                TD::make('Author')->render(function ($review){
                    return $review->author ?? '';}
                ),

                TD::make('avatar')->render(fn ($review) =>
                $review->avatar?
                    "<img src='" . asset('storage/avatars/' . $review->avatar) . "' width='33' style='border-radius:15px'/>"
                    : ''
                ),

                TD::make('rating', 'Rating'),

                $this->columnActive(),
                $this->columnAction()
            ]),

        ];
    }

    protected function modelClass()
    {
        return Review::class;
    }


    protected function namePrefix(): string
    {
        return 'platform.reviews';
    }

}
