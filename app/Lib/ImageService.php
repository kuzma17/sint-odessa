<?php

namespace App\Lib;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;

/*
 *  Intervention Image v.4
 *  https://image.intervention.io/v4
 */

class ImageService
{
    protected $image;

    public function __construct($filePath)
    {
        $manager = ImageManager::usingDriver(Driver::class);
        $this->image = $manager->decodePath($filePath);


    }

    protected function isWebp(): bool
    {
        return $this->image->encode()->mimetype() === 'image/webp';
    }

    public function resize(int $width, int $height)
    {
        $this->image->resize($width, $height);
        return $this;
    }

    public function resizeScale(int $width=null, int $height=null)
    {

        if (!$width && !$height) {
            throw new \InvalidArgumentException('At least one of width or height must be specified.');
        }

        $this->image->scale(width: $width, height: $height);

        return $this;
    }

    public function resizeCover(int $width, int $height)
    {
        $this->image->cover($width, $height);
        return $this;
    }

    public function convertToWebp(int $quality = 90)
    {
        try {

            if ($this->isWebp()){
                return $this->getImage();
            }

            return $this->image->encode(new WebpEncoder(quality: $quality));

        } catch (\Exception $e) {
            logger()->error('Error converting image: ' . $e->getMessage());
            throw new \Exception('Failed to convert image.');
        }
    }

    public function insertWatermark()
    {
        $this->image->place(
            public_path('images/watermark.png'),
            'top-left',
            24,
            24
        );
        return $this;

    }

    public function getImage()
    {
        return $this->image->encode();
    }

}