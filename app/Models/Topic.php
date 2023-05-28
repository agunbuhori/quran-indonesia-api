<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public $timestamps = false;

    public function ayahs()
    {
        return $this->belongsToMany(Ayah::class, 'topic_ayahs');
    }
}
