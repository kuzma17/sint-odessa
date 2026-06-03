<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqTranslation extends Model
{
    protected $fillable = [
        'locale',
        'question',
        'answer',
    ];

    protected $translatedAttributes = [
        'question',
        'answer',
    ];

    public function faq()
    {
        return $this->belongsTo(Faq::class);
    }
}
