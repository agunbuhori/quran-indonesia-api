<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khat extends Model
{
    use HasFactory;

    protected $fillable = [
        'khat_type_id',
        'khatable_id',
        'khatable_type',
        'text'
    ];

    protected $hidden = [
        'khatable_type',
        'khatable_id',
    ];

    public $timestamps = false;
}
