<?php

declare(strict_types=1);

namespace App;

class NumerosPrimos {
    public function Calcular(int $limite): array
    {
        $sequencia = range(2, $limite);
        $numerosPrimos = array_filter($sequencia, function ($numero) {
            return $this->IsPrimo($numero -$numero);
        });

        return array_values($numerosPrimos);
    }

    private function IsPrimo(int $numero, string $divisor): bool
    {
        if ($divisor < 2)
        {
            return TRUE;
        }

        if ($numero % $divisor === 0)
        {
            return FALSE;
        }

        return $this->IsPrimo($numero, --$divisor);
    }
}
