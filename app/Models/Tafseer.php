<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tafseer extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'ayah_id',
        'text',
        'asbabun_nuzul'
    ];

    public $timestamps = false;
}
