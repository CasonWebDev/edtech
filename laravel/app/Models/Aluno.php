<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Aluno extends Authenticatable
{
    use HasFactory;

    protected $guard = 'aluno';

    protected $fillable = [
        'nome',
        'email',
        'senha'
    ];

    protected $hidden = [
        'senha'
    ];

    public function matricula(): hasMany
    {
        return $this->hasMany(Matricula::class);
    }

    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function getGuard(): string
    {
        return $this->guard;
    }
}
