<?php

use PHPUnit\Framework\TestCase;

class BarHandlerTest extends TestCase
{
    public function testObtenerBar()
    {
        // Configurar datos de prueba
        $_GET['total'] = 100.00;
        $_GET['idsButacas'] = '1,2,3';
        $_GET['correo'] = 'test@example.com';
        $_GET['idHorario'] = 1;

        // Configurar el mock de PDO
        $mockedPdo = $this->getMockBuilder(PDO::class)
                         ->disableOriginalConstructor()
                         ->getMock();

        // Configurar el mock de PDOStatement
        $mockedStatement = $this->getMockBuilder(PDOStatement::class)
                               ->disableOriginalConstructor()
                               ->getMock();

        // Configurar el resultado de la consulta
        $experiencias = [
            ['titulo' => 'Experiencia 1', 'precio' => 20.00, 'imagen' => '...'],
            ['titulo' => 'Experiencia 2', 'precio' => 30.00, 'imagen' => '...'],
        ];

        $mockedStatement->expects($this->once())
                        ->method('fetchAll')
                        ->willReturn($experiencias);

        $mockedPdo->expects($this->once())
                  ->method('prepare')
                  ->willReturn($mockedStatement);

        // Crear una instancia de BarHandler y pasar el PDO como parámetro
        $barHandler = new BarHandler();
        $result = $barHandler->obtenerBar($mockedPdo);

        // Realizar aserciones
        $this->assertEquals($experiencias, $result);
    }
}
?>
