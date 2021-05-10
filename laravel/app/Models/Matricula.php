<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Matricula extends Model
{
    use HasFactory;

    protected $fillable = [
        'curso_id',
        'aluno_id',
        'ativo',
        'data_admissao'
    ];

    protected $appends = [
        'data_admissao_default'
    ];

    public function aluno(): BelongsTo
    {
        return $this->belongsTo(Aluno::class);
    }

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class);
    }

    public static function matriculasAluno(int $id): LengthAwarePaginator
    {
        return Matricula::with(['curso', 'aluno'])
            ->whereHas('aluno', function($q) use ($id) {
                $q->where('id', $id);
            })
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function getDataAdmissaoAttribute($value): string
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getDataAdmissaoDefaultAttribute(): string
    {
        return Carbon::parse($this->attributes['data_admissao'])->format('Y-m-d');
    }
}
