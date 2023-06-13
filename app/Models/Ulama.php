<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulama extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'kuniyah',
        'nickname',
        'ad_born',
        'ad_wafat',
        'hijri_born',
        'hijri_wafat',
        'biography',
        'level'
    ];

    public $timestamps = false;
}
