<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Request;

class Ayah extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'surah_id',
        'ayah_number',
        'hizb_number',
        'rub_el_hizb_number',
        'ruku_number',
        'manzil_number',
        'sajdah_number',
        'page_number',
        'juz_number',
    ];

    public $timestamps = false;

    /** 
     * Translations relation
     *
     * @return MorphOne
     */
    public function translation(): MorphOne
    {
        return $this->morphOne(Translation::class, 'translatable')
            ->where('translation_version_id', Request::get('translation_version_id') ?? 1);
    }

    /**
     * Khats relation
     * 
     * @return MorphOne
     */
    public function khat(): MorphOne
    {
        return $this->morphOne(Khat::class, 'khatable')
            ->where('khat_type_id', Request::get('khat_type_id') ?? 1);
    }

    public function kalimahs(): HasMany
    {
        return $this->hasMany(Kalimah::class);
    }

    public function surah()
    {
        return $this->belongsTo(Surah::class);
    }
}
