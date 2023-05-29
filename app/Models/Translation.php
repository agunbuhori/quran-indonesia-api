<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Translation extends Model
{
    use HasFactory;

    protected $fillable = [
        'translation_version_id',
        'translatable_id',
        'translatable_type',
        'text',
    ];

    protected $hidden = [
        'translatable_type',
        'translatable_id',
    ];

    public $timestamps = false;

    public function translatable(): MorphTo
    {
        return $this->morphTo();
    }
}
