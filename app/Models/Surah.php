<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surah extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'revelation_order',
        'revelation_place',
        'bismillah',
        'name_simple',
        'name_complex',
        'name_arabic',
        'name_indonesian',
        'pages',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'pages' => 'array'
    ];

    /**
     * Disable timestamps for the model.
     *
     * @var bool
     */
    public $timestamps = false;

    public function ayahs()
    {
        return $this->hasMany(Ayah::class);
    }
}
