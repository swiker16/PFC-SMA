<?php

include_once '../includes/config.php';


function obtenerInformacionPelicula($id_pelicula)
{
    // Obtener la conexión a la base de datos
    $conexion = ConnectDatabase::conectar();

    // Realizar la consulta para obtener la información de la película con el ID especificado
    $sql = "SELECT * FROM peliculas WHERE pelicula_id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id_pelicula, PDO::PARAM_INT);
    $stmt->execute();
    $pelicula = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si la película existe
    if ($pelicula) {
        // Generar el contenido HTML
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
                $html .='<div class="col-12 col-xl-6">';
                $html .='<iframe width="560" height="315" src='.$pelicula['trailer_url'].' frameborder="0" allowfullscreen></iframe>';
                $html .= ' </div>';
    } else {
        $html = '<p style="color: #fff;">La película no existe.</p>';
    }

    return $html;
}


function obtenerInformacionPeliculaEntrada($id_pelicula)
{
    // Verifica si se proporcionó el ID de la película
    if ($id_pelicula !== null) {
        // Obtén la conexión a la base de datos usando PDO
        $conexion = ConnectDatabase::conectar();

        // Realiza la consulta SQL para obtener la información de la película específica
        $sql = "SELECT horarios.Fecha_hora_inicio, horarios.sesion, salas.Nombre_sala as sala_nombre, peliculas.titulo as nombre_pelicula
        FROM horarios
        INNER JOIN salas ON horarios.sala_id = salas.sala_id
        INNER JOIN peliculas ON horarios.pelicula_id = peliculas.pelicula_id
        WHERE horarios.pelicula_id = :id";

        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id_pelicula, PDO::PARAM_INT);
        $stmt->execute();

        // Comprueba si hay resultados
        if ($stmt->rowCount() > 0) {
            $html = '<div class="container d-flex justify-content-center" >';
            $html .= '<table class="table-light">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th scope="col">Fecha</th>';
            $html .= '<th scope="col">Hora</th>';
            $html .= '<th scope="col">Sala</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';

            // Recorre los resultados y genera las filas de la tabla HTML
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $fecha_formateada = date('d-m-Y', strtotime($fila['Fecha_hora_inicio']));
                $html .= '<tr>';
                $html .= '<td>' . $fecha_formateada . '</td>';
                $html .= '<td>' . $fila['sesion'] . '</td>';
                $html .= '<td>' . $fila['sala_nombre'] . '</td>';
                $html .= '</tr>';
            }

            $html .= '</tbody>';
            $html .= '</table>';
            $html .= '</div>';
        } else {
            // Muestra el mensaje de error con el nombre de la película en lugar del ID
            $sql = "SELECT titulo FROM peliculas WHERE pelicula_id = :id_pelicula";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id_pelicula', $id_pelicula, PDO::PARAM_INT);
            $stmt->execute();

            $nombre_pelicula = $stmt->fetch(PDO::FETCH_ASSOC)['titulo'];

            $html = '<div class="container">';
            $html .= '<p style="color: #fff;">No hay fecha para la película ' . $nombre_pelicula . '</p>';
            $html .= '</div>';
        }

        return $html;
    } else {
        return 'ID de película no proporcionado.';
    }
}
