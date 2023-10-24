<?php

use PHPUnit\Framework\TestCase;
include 'src/Operations.php';

class OperationsTest extends TestCase
{

    public function testSuma() {
        $resultado = Operations::sumar(2, 2);
        $this->assertEquals(4, $resultado);
    }

}