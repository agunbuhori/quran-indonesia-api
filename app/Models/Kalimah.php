<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Kalimah extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'position',
        'char_type_name',
        'page_number',
        'line_number',
        'text',
        'text_v2',
        'text_uthmani',
        'text_hafs',
    ];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function translation()
    {
        return $this->morphOne(Translation::class, 'translatable')
            ->where('translation_version_id', Request::get('translation_version_id') ?? 1);
    }

    public function khat()
    {
        return $this->morphOne(Khat::class, 'khatable')
            ->where('khat_type_id', Request::get('khat_type_id') ?? 1);
    }
}
