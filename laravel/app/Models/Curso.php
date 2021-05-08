<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'data_inicio'
    ];

    public function matricula(): HasOne
    {
        return $this->hasOne(Matricula::class);
    }
}
