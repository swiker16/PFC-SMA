<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

class ProcesarPago
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function actualizarButacas($idsButacas)
    {
        $idsButacasArray = explode(',', $idsButacas);

        // Escapar y formatear los IDs para la consulta SQL
        $idsButacasArray = array_map(function ($id) {
            return intval($id);
        }, $idsButacasArray);

        $idsButacasStr = implode(',', $idsButacasArray);
        // Actualizar la tabla de asientos (suponiendo que existe una columna llamada 'estado' que representa si está ocupado o no)
        $sql = "UPDATE asientos SET estado_asiento = 'Ocupado' WHERE id_asiento IN ($idsButacasStr)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
    }

    public function realizarReserva($idsButacas, $usuarioId, $correoUsuario, $horarioId)
    {

        $idsButacasArray = explode(',', $idsButacas);
        foreach ($idsButacasArray as $asientoId) {
            // Obtener información sobre el asiento desde la base de datos (ajusta según tu esquema)
            $infoAsiento = $this->obtenerInfoAsiento($asientoId);
            // Realizar inserción en la tabla de reservas
            $sql = "INSERT INTO reservas (usuario_id, horario_id, asiento_id, correo_cliente) VALUES (:usuario_id, :horario_id, :asiento_id, :correo_usuario)";
            $stmt = $this->conexion->prepare($sql);

            $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
            $stmt->bindParam(':horario_id', $horarioId, PDO::PARAM_INT);
            $stmt->bindParam(':asiento_id', $asientoId, PDO::PARAM_INT);
            $stmt->bindParam(':correo_usuario', $correoUsuario, PDO::PARAM_STR);
            $stmt->execute();

            ProcesarPago::enviarCorreo($correoUsuario, $infoAsiento);
        }
    }

    private function obtenerInfoAsiento($asientoId)
    {
        // Consulta para obtener información del asiento (ajusta según tu esquema)
        $sql = "SELECT a.*, p.titulo AS titulo_pelicula, s.nombre_sala FROM asientos a
            INNER JOIN horarios h ON a.id_asiento = h.Horario_ID
            INNER JOIN peliculas p ON h.Pelicula_ID = p.pelicula_id
            INNER JOIN salas s ON h.Sala_ID = s.Sala_ID
            WHERE a.id_asiento = :asiento_id";
    
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':asiento_id', $asientoId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    public function enviarCorreo($email, $infoAsiento)
    {
        // Configuración de PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.hostinger.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'no-reply@magiccinema.es';
            $mail->Password = '';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('no-reply@magiccinema.es', 'no-reply@magiccinema.es');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Reserva Confirmada.';
            $mail->Body = 'Gracias por tu reserva. Aquí está la información detallada:<br><br>' .
            'Película: ' . $infoAsiento['titulo_pelicula'] . '<br>' .
            'Sala: ' . $infoAsiento['nombre_sala'] . '<br>' .
            'Asiento: Fila ' . $infoAsiento['numero_fila'] . ', Columna ' . $infoAsiento['numero_columna'] . '<br>';
        

            $mail->send();
        } catch (Exception $e) {
            echo "Error al enviar el correo de confirmación: {$mail->ErrorInfo}";
        }
    }
}
