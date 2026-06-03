<?php

namespace App\Orchid\Screens;

use App\Services\MediaService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Toast;

abstract class BaseEditScreen extends Screen
{

    public ?Model $model = null;

    //abstract protected function nameRouteList(): string;

    abstract protected function namePrefix(): string;

    protected function nameList()
    {
        return $this->namePrefix();
    }

//    protected function nameCreate()
//    {
//        return $this->namePrefix() . '.create';
//    }

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
            $this->nameEdit(),
        ];
    }

    protected function getTranslations(): array
    {
        if (!$this->model || !$this->model->exists) {
            return [];
        }

        return $this->model
            ->translations
            ->keyBy('locale')
            ->toArray();
    }

    protected function getAttachments(?string $group = null)
    {
        if (!$this->model || !$this->model->exists) {
            return [];
        }

        return $group
            ? $this->model->attachments($group)->get()
            : $this->model->attachments;

    }

    protected function getButtons($deleteButton=true)
    {
        $buttons = [
            Link::make('list')
                ->icon('bs.list')
                ->route($this->nameList())
                ->type(Color::PRIMARY),

            Button::make('Save')
                ->name('save')
                ->icon('bs.check')
                ->method('save')
                ->type(Color::SUCCESS),
        ];

        if ($deleteButton){
            $buttons[] = Button::make('Delete')
                ->name('delete')
                ->icon('bs.trash')
                ->method('remove')
                ->type(Color::DANGER)
                ->confirm('Вы уверены, что хотите удалить запись?')
                ->canSee($this->model->exists && auth()->user()?->hasAccess($this->nameDelete()));
                //->canSee($this->model->exists);
        }
        return $buttons;
    }

    protected function saveModel(array $data): Model
    {
        $this->model->fill($data)->save();
        return $this->model;
    }

    protected function saveTranslations(array $translations): void
    {
        foreach ($translations as $locale => $data) {
            $this->model->translations()->updateOrCreate(
                ['locale' => $locale],
                $data
            );
        }
    }

    protected function syncImage(
        array $attachmentIds,
        string $preset,
        ?string $group = null,
        ?string $alt = null,
        ?string $description = null
    ): void {

        $relation = $group
            ? $this->model->attachments($group)
            : $this->model->attachments();

        // текущие attachment этой группы
        $oldAttachments = $relation->get();

        $currentIds = $oldAttachments
            ->pluck('id')
            ->toArray();

        // какие нужно удалить из группы
        $toDetach = array_diff($currentIds, $attachmentIds);

        // какие новые
        $newIds = array_diff($attachmentIds, $currentIds);

        // удалить старые pivot только этой группы
        if (!empty($toDetach)) {
            $relation->detach($toDetach);
        }

        // добавить новые pivot
        if (!empty($attachmentIds)) {
            $relation->syncWithoutDetaching($attachmentIds);
        }

        // process только новые картинки
        foreach ($newIds as $id) {
            app(MediaService::class)->processAttachment(
                $id,
                $preset,
                $group,
                $alt,
                $description
            );
        }

        // cleanup старых attachment
        foreach ($oldAttachments as $old) {
            if (in_array($old->id, $toDetach)) {
                Storage::disk('public')->delete(
                    attachment_path($old)
                );
                $old->delete();
            }
        }
    }

//    protected function clearEmptyRepeater(
//        array $items,
//        string $field = 'title'
//    ): array {
//
//        return array_values(
//
//            array_filter($items, function ($item) use ($field) {
//
//                $value = data_get($item, "$field.ru");
//
//                return !empty(trim($value ?? ''));
//
//            })
//
//        );
//    }

    public function remove()
    {
        abort_unless(
            auth()->user()->hasAccess($this->nameDelete()),
            403
        );

        $this->model->remove();
        Toast::info('Deleted');
        return redirect()->route($this->nameList());
    }
}
