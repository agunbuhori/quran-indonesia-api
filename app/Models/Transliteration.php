<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transliteration extends Model
{
    use HasFactory;

    protected $fillable = [
        'transliterable_id',
        'transliterable_type',
        'text'
    ];

    public $timestamps = false;
}
