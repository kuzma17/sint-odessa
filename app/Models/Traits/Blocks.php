<?php

namespace App\Models\Traits;

use App\Models\Brand;
use App\Models\Faq;
use App\Models\Review;
use Illuminate\Support\Collection;

trait Blocks
{
    public function hasBlock(string $block): bool
    {
        if (data_get($this->blocks, "{$block}_show") !== null)  // DB blocks
        {
            return data_get($this->blocks, "{$block}_show")
                && (int) data_get($this->blocks, "{$block}_count") > 0;
        }

        $content = data_get($this->blocks, $block); // json blocks

        return is_array($content) && count($content) > 0;
    }

    public function jsonBlockRaw(string $key, $default = [])
    {
        return data_get($this->blocks, $key, $default);
    }

    public function jsonBlock(string $key, $default = [])
    {
        $items = $this->jsonBlockRaw($key, $default);

        if (!is_array($items)) {
            return $items;
        }

        return collect($items)->map(function ($item) {
            foreach ($item as $k => $value) {
                $item[$k] = translateField($value);
            }
            return $item;
        })->toArray();
    }

//    public function brandsBlock($count=3, $group=null): Collection
//    {
//        $group = $group ?: $this->slug;
//
//        if (!$this->hasBlock('brands')) {
//            return collect();
//        }
//
//        return Brand::getBrands(
//            $group,
//            (int) $count
//        );
//    }
//
//    public function reviewsBlock($count=3, $group=null): Collection
//    {
//        $group = $group ?: $this->slug;
//
//        if (!$this->hasBlock('reviews')) {
//            return collect();
//        }
//
//        return Review::getReviews(
//            $group,
//            (int) $count
//        );
//    }
//
//    public function faqBlock($count=3, $group=null): Collection
//    {
//        $group = $group ?: $this->slug;
//
//        if (!$this->hasBlock('faq')) {
//            return collect();
//        }
//
//        return Faq::getFaq(
//            $group,
//            (int) $count
//        );
//    }

//    public function jsonBlock(string $key, mixed $default = []): array
//    {
//        if (!$this->hasBlock($key)) {
//            return [];
//        }
//
//        return $this->block($key, $default);
//    }
//
//    public function jsonBlockOrNull(string $key): ?array
//    {
//        $data = $this->jsonBlock($key);
//
//        return empty($data) ? null : $data;
//    }

}