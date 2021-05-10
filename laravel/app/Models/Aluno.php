<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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

    public function matriculas(): hasMany
    {
        return $this->hasMany(Matricula::class);
    }

    public static function lista(): LengthAwarePaginator
    {
        return Aluno::with('matriculas')->orderBy('id', 'DESC')->paginate(10);
    }

    public function getAuthPassword()
    {
        return $this->senha;
    }
}
