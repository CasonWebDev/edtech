<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\NumerosPrimos;

class NumerosPrimosTest extends TestCase
{
    public function testNumerosPrimos()
    {
        $numerosEsperados = [
            2,
            3,
            5,
            7,
            11,
            13
        ];

        $limite = 15;

        $numerosPrimos = new NumerosPrimos();

        $numerosRecebidos = $numerosPrimos->calcular($limite);

        $this->assertEquals($numerosEsperados, $numerosRecebidos);
    }
}
