<?php

namespace App\Services;

use App\Lib\ImageService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Orchid\Attachment\Models\Attachment;

class MediaService
{

    public function handle(string $file, array $options): string
    {
        $realPath = Storage::disk('public')->path($file);

        $fileName = $options['path'] . '/' . Str::uuid() . '.webp';

        $image = (new ImageService($realPath))
            ->resizeCover($options['width'], $options['height'])
            ->convertToWebp($options['quality'] ?? 80);

        Storage::disk('public')->put($fileName, $image);

        return $fileName;
    }

    public function processAttachment(
        int $attachmentId,
        string $preset,
        ?string $group = null,
        ?string $alt = null,
        ?string $description = null
    ): void {

        $attachment = Attachment::findOrFail($attachmentId);

        $options = $this->getOptions($preset);

        $originalFile = attachment_path($attachment);

        $newFile = $this->handle($originalFile, $options);
        $fullPath = Storage::disk('public')->path($newFile);

        // удалить original
        //$this->deleteFile($originalFile);

        // обновить attachment
        $data = [
            'path' => dirname($newFile).'/',
            'name' => pathinfo($newFile, PATHINFO_FILENAME),
            'extension' => 'webp',
            'mime' => 'image/webp',
            'size' => filesize($fullPath),
            'hash' => md5_file($fullPath),
        ];

        if ($group){
            $data['group'] = $group;
        }

        if ($alt){
            $data['alt'] = $alt;
        }

        if ($description){
            $data['description'] = $description;
        }

        $attachment->update($data);
    }

    protected function getOptions($preset): array
    {
        $options = config("image.presets.$preset");

        if (!$options) {
            throw new \Exception("Preset [$preset] not found");
        }

        return $options;

    }

    protected function deleteFile($file):void
    {
        Storage::disk('public')->delete($file);
    }

    public function delete($attachment): void
    {
        Storage::disk('public')->delete(
            attachment_path($attachment)
        );

        $attachment->delete();
    }


}