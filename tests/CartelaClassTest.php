<?php

use PHPUnit\Framework\TestCase;

include 'includes/carteleraFunctions.php';

/**
 * @runInSeparateProcess
 * @preserveGlobalState disabled
 */
class CartelaClassTest extends TestCase
{
    
    public function testMostrarTopPeliculas()
    {
        ob_start();
        try {
            $cartelaClass = new CartelaClass();
            $cartelaClass->mostrarTopPeliculas();
        } finally {
            ob_end_clean();
        }
    }


    public function testMostrarCartelera()
    {
        ob_start();
        try {
            $cartelaClass = new CartelaClass();
            $cartelaClass->mostrarCartelera();
        } finally {
            ob_end_clean();
        }
    }
}
