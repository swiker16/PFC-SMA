
function buscarPeliculas() {

    var busqueda = document.getElementById('busqueda-input').value;

    var xhr = new XMLHttpRequest();
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {

            var dropdown = document.getElementById('resultados-busqueda');

            dropdown.innerHTML = '';

            var resultados = xhr.responseText.split(';');
            resultados.forEach(function(resultado) {
                var listItem = document.createElement('li');
                listItem.innerHTML = resultado;
                listItem.className = 'dropdown-item';
                dropdown.appendChild(listItem);
            });

            if (busqueda !== '' && resultados.length > 0) {
                dropdown.style.display = 'block';
            } else {
                dropdown.style.display = 'none';
            }
        }
    };

    xhr.open('GET', '../includes/buscar_peliculas.php?q=' + busqueda, true);
    xhr.send();
}

document.getElementById('busqueda-input').addEventListener('input', buscarPeliculas);
