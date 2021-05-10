<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'data_inicio'
    ];

    protected $appends = [
        'data_inicio_default'
    ];

    public function matriculas(): HasMany
    {
        return $this->hasMany(Matricula::class);
    }

    public static function lista(): LengthAwarePaginator
    {
        return Curso::with('matriculas')->orderBy('id', 'DESC')->paginate(10);
    }

    public function getDataInicioAttribute($value): string
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getDataInicioDefaultAttribute(): string
    {
        return Carbon::parse($this->attributes['data_inicio'])->format('Y-m-d');
    }
}
