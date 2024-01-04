<?php

include_once '../includes/config.php';

class InfoPeliculaHandler
{
    public static function obtenerInformacionPelicula($id_pelicula)
    {
        $conexion = ConnectDatabase::conectar();
        $pelicula = self::obtenerPeliculaPorID($conexion, $id_pelicula);

        if ($pelicula) {
            $html = '<div class="container">';
            $html .= '<div class="row">';
            $html .= '<div class="col-12">';
            $html .= '<h1 class="details__title">' . $pelicula['titulo'] . '</h1>';
            $html .= '</div>';

            $html .= '<div class="col-12 col-xl-6">';
            $html .= '<div class="card card--details border border-0" style="background-color: transparent;">';
            $html .= '<div class="row">';
            $html .= '<div class="col-12 col-sm-4 col-md-4 col-lg-3 col-xl-5">';
            $html .= '<div class="card__cover">';
            $html .= '<img src="data:image/jpeg;base64,' . base64_encode($pelicula['imagen']) . '" class="card-img-top" alt="' . $pelicula['titulo'] . '">';
            $html .= '</div>';
            $html .= '</div>';

            $html .= '<div class="col-12 col-sm-8 col-md-8 col-lg-9 col-xl-7">';
            $html .= '<div class="card__content">';
            $html .= '<div class="card__wrap">';
            $html .= '<ul class="card__list">';
            $html .= '<li> +' . $pelicula['clasificacion'] . '</li>';
            $html .= '</ul>';
            $html .= '</div>';
            $html .= '<ul class="card__meta">';
            $html .= '<li><span>Genero:</span> <a href="#">' . $pelicula['genero'] . '</a></li>';
            $html .= '<li><span>Fecha de Lanazamiento:</span> ' . $pelicula['fecha_de_estreno'] . '</li>';
            $html .= '<li><span>Duración:</span> ' . $pelicula['duracion'] . '</li>';
            $html .= '</ul>';
            $html .= '<div class="card__description card__description--details">';
            $html .= $pelicula['descripcion'] . '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="col-12 col-xl-6">';
            $html .= '<iframe width="560" height="315" src=' . $pelicula['trailer_url'] . ' frameborder="0" allowfullscreen class="container"></iframe>';
            $html .= ' </div>';

            return $html;
        } else {
            return '<p style="color: #fff;">La película no existe.</p>';
        }
    }

    public static function obtenerInformacionPeliculaEntrada($id_pelicula)
    {
        $conexion = ConnectDatabase::conectar();

        if ($id_pelicula !== null) {
            $html = '<div class="container">';
            $html .= '<div class="row">';

            $horarios = self::obtenerHorariosPelicula($conexion, $id_pelicula);

            if ($horarios) {
                foreach ($horarios as $fila) {
                    $html .= '<div class="col-sm-4 mb-3 mb-sm-0">';
                    $html .= '<div class="card " style="box-shadow: 0 5px 25px 0 rgba(0,0,0,0.3); border: 2px solid transparent; border-image: linear-gradient(90deg, #ff55a5 0%, #ff5860 100%); border-image-slice: 1; background-color: #28282d;">';
                    $html .= '<div class="card-body p-3">';
                    $html .= '<h4 class="card-title text-white fw-bolder" style ="font-family: \'Open Sans\', sans-serif;">' . $fila['nombre_pelicula'] . '</h4>';
                    $fechaFormateada = date('d-m-Y', strtotime($fila['Fecha_hora_inicio']));

                    $html .= '<p class="card-text text-white" style ="font-family: \'Open Sans\', sans-serif;"><strong>Fecha:</strong> ' . $fechaFormateada . '</p>';
                    $html .= '<p class="text-white" style="font-family: \'Open Sans\', sans-serif;"><strong>Sala:</strong> ' . $fila['sala_nombre'] . '</p>';
                    $horaFormateada = date('H:i', strtotime($fila['Fecha_hora_inicio']));

                    $html .= '<p class="text-white" style="font-family: \'Open Sans\', sans-serif;"><strong>Sesión:</strong> ' . $horaFormateada . '</p>';
                    $html .= '<a href="comprarEntrada.php?id=' . $fila['Horario_id'] . '" class="" style="background: linear-gradient(90deg, #ff55a5 0%, #ff5860 100%); border: none; color: #fff; padding: 10px 20px; border-radius: 5px;">Comprar Entrada</a>';
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</div>';
                }

                $html .= '</div>';
                $html .= '</div>';
            } else {

                // Muestra el mensaje de error con el nombre de la película en lugar del ID
                $nombre_pelicula = self::obtenerNombrePeliculaPorID($conexion, $id_pelicula);

                $html .= '<div class="container">';
                $html .= '<p style="color: #fff; font-family: \'.Open Sans\', sans-serif;">No hay fecha para la película ' . $nombre_pelicula . '</p>';
                $html .= '</div>';
            }

            return $html;
        } else {
            return 'ID de película no proporcionado.';
        }
    }

    private static function obtenerPeliculaPorID($conexion, $id_pelicula)
    {
        $sql = "SELECT * FROM peliculas WHERE pelicula_id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id_pelicula, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private static function obtenerHorariosPelicula($conexion, $id_pelicula)
    {
        $sql = "SELECT horarios.Horario_id, horarios.Fecha_hora_inicio, horarios.sesion, salas.Nombre_sala as sala_nombre, peliculas.titulo as nombre_pelicula
            FROM horarios
            INNER JOIN salas ON horarios.sala_id = salas.sala_id
            INNER JOIN peliculas ON horarios.pelicula_id = peliculas.pelicula_id
            WHERE horarios.pelicula_id = :id
            AND horarios.Fecha_hora_inicio >= NOW()";

        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id_pelicula, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $resultados = [];
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $resultados[] = $fila;
            }
            return $resultados;
        } else {
            return false;
        }
    }

    private static function obtenerNombrePeliculaPorID($conexion, $id_pelicula)
    {
        $sql = "SELECT titulo FROM peliculas WHERE pelicula_id = :id_pelicula";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id_pelicula', $id_pelicula, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['titulo'];
    }
}
