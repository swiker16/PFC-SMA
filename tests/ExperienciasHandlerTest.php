<?php

use PHPUnit\Framework\TestCase;

class ExperienciasHandlerTest extends TestCase
{
    public function testObtenerExperienciasLimitadas()
    {
        // Configura el mock de PDOStatement para la consulta de execute
        $mockStmt = $this->createMock(PDOStatement::class);
        $mockStmt->expects($this->once())
                 ->method('bindParam')
                 ->with(':limite', 5, PDO::PARAM_INT);
        $mockStmt->expects($this->once())
                 ->method('execute');

        // Configura el mock de PDO para query y prepare
        $mockPDO = $this->createMock(PDO::class);
        $mockPDO->expects($this->once())
                ->method('prepare')
                ->willReturn($mockStmt);

        // Crea una instancia de ExperienciasHandler con el PDO simulado
        $experienciasHandler = new ExperienciasHandler();

        // Ejecuta el método a probar
        $experiencias = $experienciasHandler->obtenerExperienciasLimitadas($mockPDO, 5);

        // Asegura que el resultado no es nulo
        $this->assertNotNull($experiencias);

        // Puedes agregar más aserciones según sea necesario
    }

    public function testGenerarHTMLExperienciasSalas()
    {
        // Configura el mock de experiencias simuladas
        $experiencias = [
            ['imagen' => 'imagen1', 'titulo' => 'Experiencia 1', 'descripcion' => 'Descripción 1'],
            ['imagen' => 'imagen2', 'titulo' => 'Experiencia 2', 'descripcion' => 'Descripción 2'],
        ];

        // Crea una instancia de ExperienciasHandler (no se necesita mock para este caso)
        $experienciasHandler = new ExperienciasHandler();

        // Ejecuta el método a probar
        $html = $experienciasHandler->generarHTMLExperienciasSalas($experiencias);

        // Asegura que el HTML generado contiene partes esperadas
        $this->assertStringContainsString('<div class="row d-flex justify-content-center">', $html);
        $this->assertStringContainsString('Experiencia 1', $html);
        $this->assertStringContainsString('Descripción 2', $html);

        // Puedes agregar más aserciones según sea necesario
    }
}

?>