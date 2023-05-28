<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranslationVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'author'
    ];

    public $timestamps = false;
}
