<?php

namespace App\Models\Traits;

use function PHPUnit\Framework\isArray;

trait Translations
{

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        return $this->translations
            ->where('locale', $locale)
            ->first();
    }

    public function getTitleAttribute()
    {
        return $this->translation()->title;
    }

    public function getSubTitleAttribute()
    {
        return $this->translation()->subtitle;
    }

    public function getDescriptionAttribute()
    {
        return $this->translation()->description;
    }

    public function getContentAttribute()
    {
        return $this->translation()->content;
    }

    public function getSeoTitleAttribute()
    {
        return $this->translation()->seo_title;
    }

    public function getSeoDescriptionAttribute()
    {
        return $this->translation()->seo_description;
    }

    public function getSeoKeywordsAttribute()
    {
        return $this->translation()->seo_keywords;
    }

    public function getOgTitleAttribute()
    {
        return $this->translation()->og_title;
    }

    public function getOgDescriptionAttribute()
    {
        return $this->translation()->og_description;
    }

    public function getAnswerAttribute()
    {
        return $this->translation()->answer;
    }

    public function getQuestionAttribute()
    {
        return $this->translation()->question;
    }

    public function getAddressAttribute()
    {
        return $this->translation()->address;
    }

}