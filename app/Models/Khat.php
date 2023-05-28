<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khat extends Model
{
    use HasFactory;

    protected $fillable = [
        'ayah_id',
        'khat_type_id',
        'text'
    ];

    public $timestamps = false;
}
