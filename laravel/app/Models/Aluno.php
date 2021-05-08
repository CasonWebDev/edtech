<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'senha'
    ];

    public function matricula(): hasMany
    {
        return $this->hasMany(Matricula::class);
    }
}
