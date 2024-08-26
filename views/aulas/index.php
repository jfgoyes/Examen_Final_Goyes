<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de aulas</title>
    
    <!-- Carga de estilos Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Carga de Axios para las peticiones HTTP -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Carga de scripts presentes en Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: white;
            font-family: Arial, Helvetica, sans-serif;
        }
        .centrado {
            text-align: center;
        }
        .nav-link, .nav-item {
            font-family: Arial, Helvetica, sans-serif;
        }
        .navbar-brand {
            font-family: Georgia, 'Times New Roman', Times, serif;
        }
        .nav-link:hover, .navbar-brand:hover {
            text-decoration: underline;
        }
        .btn-success, .btn-warning, .btn-secondary {
            background-color: gray;
            border: black;
            color: white;
        }
        .btn-danger {
            background-color: red;
            border: black;
            color: white;
        }
        .btn-primary {
            background-color: green;
            border: black;
            color: white;
        }
        .btn-success:hover, .btn-warning:hover, .btn-secondary:hover {
            background-color: blue;
            text-decoration: underline;
            color: white;
        }
        .btn-danger:hover {
            background-color: white;
            text-decoration: underline;
            color: black;
        }
        .btn-primary:hover {
            background-color: white;
            text-decoration: underline;
            color: black;
        }
        .table {
            background-color: gold;
            border: black;
        }
    </style>
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="https://www.espe.edu.ec/">Universidad de las Fuerzas Armadas</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/Examen_Final_Goyes_Job/inicio">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Examen_Final_Goyes_Job/aulas">Gestión de aulas</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1 class="mt-5">Lista de aulas</h1>
        
        <!-- Botón para abrir el modal de agregar/editar aula -->
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#aulasModal">Agregar</button>
        
        <!-- Tabla para mostrar las aulas -->
        <table class="table table-striped mt-4" id="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Número de Estudiantes</th>
                    <th>Capacidad Máxima</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($aulas as $aula) : ?>
                    <tr data-id="<?php echo $aula->aula_id; ?>">
                        <td><?php echo $aula->aula_id; ?></td>
                        <td><?php echo $aula->aula_nombre; ?></td>
                        <td><?php echo $aula->aula_numero_estudiantes; ?></td>
                        <td><?php echo $aula->aula_capacidad_maxima; ?></td>
                        <td><?php echo $aula->aula_tipo; ?></td>
                        <td>
                            <!-- Botones para editar y eliminar aula -->
                            <button class="btn btn-warning btnEditar">Editar</button>
                            <button class="btn btn-danger btnEliminar">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para agregar o editar aula -->
    <div class="modal fade" id="aulasModal" tabindex="-1" aria-labelledby="aulasModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aulasModalLabel">Crear aula</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para ingresar los datos del aula -->
                    <div class="form-floating mb-3">
                        <input type="text" name="aula_nombre" class="form-control" placeholder="Nombre">
                        <label>Nombre</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="aula_numero_estudiantes" class="form-control" placeholder="Número de Estudiantes">
                        <label>Número de Estudiantes</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="aula_capacidad_maxima" class="form-control" placeholder="Capacidad Máxima">
                        <label>Capacidad Máxima</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="aula_tipo" class="form-control" placeholder="Tipo">
                        <label>Tipo</label>
                    </div>
                </div>
                <input type="hidden" id="identificador" value="">
                <div class="modal-footer">
                    <!-- Botones de acción del modal -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-guardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Inicializa el modal usando Bootstrap
        let myModal = new bootstrap.Modal(document.getElementById('aulasModal'));

        // Función para cargar los datos de un aula en el modal para edición
        const fetchAula = (event) => {
            let id = event.target.closest('tr').dataset.id;
            axios.get(`http://localhost/Examen_Final_Goyes_Job/aulas/find/${id}`).then((res) => {
                let info = res.data;
                document.querySelector("#aulasModalLabel").textContent = "Editar Aula";
                document.querySelector('input[name="aula_nombre"]').value = info.aula_nombre;
                document.querySelector('input[name="aula_numero_estudiantes"]').value = info.aula_numero_estudiantes;
                document.querySelector('input[name="aula_capacidad_maxima"]').value = info.aula_capacidad_maxima;
                document.querySelector('input[name="aula_tipo"]').value = info.aula_tipo;
                document.querySelector('#identificador').value = id;
                myModal.show();
            });
        }

        // Función para eliminar un aula
        const deleteAula = (event) => {
            let id = event.target.closest('tr').dataset.id;
            axios.delete(`http://localhost/Examen_Final_Goyes_Job/aulas/delete/${id}`).then((res) => {
                let info = res.data;
                if (info.status) {
                    document.querySelector(`tr[data-id="${id}"]`).remove();
                }
            });
        }

        // Inicializa el modal para la creación de un nuevo aula
        document.querySelector('.btn.btn-success')
            .addEventListener('click', () => {
                document.querySelector("#aulasModalLabel").textContent = "Crear Aula";
                // Limpia los campos del formulario
                document.querySelector('input[name="aula_nombre"]').value = "";
                document.querySelector('input[name="aula_numero_estudiantes"]').value = "";
                document.querySelector('input[name="aula_capacidad_maxima"]').value = "";
                document.querySelector('input[name="aula_tipo"]').value = "";
                document.querySelector('#identificador').value = "";
                // Muestra el modal
                myModal.show();
            });

        // Función para guardar o actualizar un aula
        document.querySelector('.btn-guardar')
            .addEventListener('click', () => {
                let aula_nombre = document.querySelector('input[name="aula_nombre"]').value;
                let aula_numero_estudiantes = document.querySelector('input[name="aula_numero_estudiantes"]').value;
                let aula_capacidad_maxima = document.querySelector('input[name="aula_capacidad_maxima"]').value;
                let aula_tipo = document.querySelector('input[name="aula_tipo"]').value;
                let id = document.querySelector('#identificador').value;

                // Envía una solicitud POST para crear o actualizar el aula
                axios.post(`http://localhost/Examen_Final_Goyes_Job/aulas/${id === "" ? 'create' : 'update'}`, {
                        aula_nombre,
                        aula_numero_estudiantes,
                        aula_capacidad_maxima,
                        aula_tipo,
                        aula_id: id
                    })
                    .then((res) => {
                        let info = res.data;
                        if (id === "") {
                            // Si el ID está vacío, se trata de una creación
                            let tr = document.createElement("tr");
                            tr.setAttribute('data-id', info.aula_id);
                            tr.innerHTML = `<td>${info.aula_id}</td>
                                            <td>${info.aula_nombre}</td>
                                            <td>${info.aula_numero_estudiantes}</td>
                                            <td>${info.aula_capacidad_maxima}</td>
                                            <td>${info.aula_tipo}</td>
                                            <td><button class='btn btn-warning btnEditar'>Editar</button>
                                            <button class='btn btn-danger btnEliminar'>Eliminar</button></td>`;
                            // Añade la nueva fila a la tabla
                            document.getElementById("table").querySelector("tbody").append(tr);
                            // Asocia los botones de la nueva fila con sus respectivas funciones
                            tr.querySelector('.btnEditar').addEventListener('click', fetchAula);
                            tr.querySelector('.btnEliminar').addEventListener('click', deleteAula);
                        } else {
                            // Si el ID no está vacío, se trata de una actualización
                            let tr = document.querySelector(`tr[data-id="${id}"]`);
                            let cols = tr.querySelectorAll("td");
                            cols[1].textContent = info.aula_nombre;
                            cols[2].textContent = info.aula_numero_estudiantes;
                            cols[3].textContent = info.aula_capacidad_maxima;
                            cols[4].textContent = info.aula_tipo;
                        }
                        // Oculta el modal
                        myModal.hide();
                    });
            });

        // Añade event listeners para los botones de editar y eliminar existentes
        document.querySelectorAll('.btnEditar').forEach(btn => btn.addEventListener('click', fetchAula));
        document.querySelectorAll('.btnEliminar').forEach(btn => btn.addEventListener('click', deleteAula));
    </script>
</body>
</html>