<?php

namespace App\Orchid\Screens;

use Illuminate\Support\HtmlString;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Support\Facades\Toast;

abstract class BaseListScreen extends Screen
{
    abstract protected function modelClass();

    abstract protected function namePrefix(): string;

    protected function nameList()
    {
        return $this->namePrefix();
    }

    protected function nameCreate()
    {
        return $this->namePrefix() . '.create';
    }

    protected function nameEdit()
    {
        return $this->namePrefix() . '.edit';
    }

    protected function nameDelete()
    {
        return $this->namePrefix() . '.delete';
    }

    public function permission(): ?iterable
    {
        return [
            $this->nameList(),
        ];
    }

    private function getTranslation($model, string $locale = 'ru')
    {
        return $model->translations
            ->firstWhere('locale', $locale);

    }

    protected function columnTtitle(string $title='Title')
    {
        return TD::make('title', $title)
            ->render(function ($model) {
                return optional(
                $this->getTranslation($model)
                )->title;
            });

    }

    protected function columnSubTtitle(string $title='Sub Title')
    {
        return TD::make('subtitle', $title)
            ->render(function ($model) {
                return optional(
                    $this->getTranslation($model)
                )->subtitle;
            });

    }

    protected function columnImage(string $title='image', string $group = null): TD
    {
        return TD::make($title)
            ->render(function ($model) use ($group) {

                $image = $group
                    ? $model->attachments->where('group', $group)->first()
                    : $model->attachments->first();

                if (!$image) {
                    return '';
                }

                return "<img src='{$image->url()}' height='50' />";
            });
    }

    protected function columnAction(string $title='Actions'): TD
    {
        return TD::make($title)->render(function ($model) {

            $edit = Link::make('')
                ->icon('pencil')
                ->route($this->nameEdit(), $model)
                ->type(Color::SUCCESS)
                ->canSee(auth()->user()?->hasAccess($this->nameEdit()));

            $delete = Button::make('')
                ->method('remove', ['id' => $model->id])
                ->icon('trash')
                ->confirm('Вы уверены, что хотите удалить запись?')
                ->type(Color::DANGER)
                ->canSee(auth()->user()?->hasAccess($this->nameDelete()));

            return new HtmlString(
                "<div class='d-flex gap-2 align-items-center'>{$edit->render()} {$delete->render()}</div>"
            );
        });
    }

    protected function createButton(string $title = 'Create'): array
    {
        return [Link::make($title)
            ->icon('plus')
            ->type(Color::SUCCESS)
            ->route($this->nameCreate())
            ->canSee(auth()->user()?->hasAccess($this->nameCreate()))
        ];
    }

    protected function columnActive($title='active')
    {
        return TD::make($title)
            ->render(function ($model) {

                return Button::make(
                    $model->active ? 'ON' : 'OFF'
                )
                    ->method('toggleActive', [
                        'id' => $model->id
                    ])
                    ->type(
                        $model->active
                            ? \Orchid\Support\Color::SUCCESS
                            : \Orchid\Support\Color::DARK
                    );
            })->canSee(auth()->user()?->hasAccess($this->nameEdit()));

    }

    public function toggleActive(int $id): void
    {
        $model = $this->modelClass()::findOrFail($id);

        $model->update([
            'active' => !$model->active
        ]);
    }

    public function remove($id)
    {
        abort_unless(
            auth()->user()->hasAccess($this->nameDelete()),
            403
        );

        $model = $this->modelClass()::findOrFail($id);
        $model->remove();
        Toast::info('Deleted');
        return redirect()->back();
    }



}
