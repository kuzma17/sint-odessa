<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficeTranslation extends Model
{
    protected $fillable = [
        'office_id',
        'locale',
        'title',
        'subtitle',
        'content',
        'address',
    ];
}
