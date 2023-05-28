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
        'ayah_id',
        'text',
    ];

    public $timestamps = false;

    public function translatable(): MorphTo
    {
        return $this->morphTo();
    }
}
