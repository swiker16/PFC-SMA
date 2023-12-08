
function buscarPeliculas() {

    var busqueda = document.getElementById('busqueda-input').value;

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {

            document.getElementById('resultados-busqueda').innerHTML = xhr.responseText;
        }
    };

    xhr.open('GET', 'includes/buscar_peliculas.php?q=' + busqueda, true);
    xhr.send();
}

document.getElementById('busqueda-input').addEventListener('input', buscarPeliculas);
