<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sistemas de Asistencias</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        h1.mt-4 {
            font-size: 27px; /* Ajusta el tamaño de la fuente según tus preferencias */
            font-weight: bold; /* Hace que el texto sea más audaz (serio) */
            font-family: "Arial", sans-serif; /* Cambia la fuente a una más seria si es necesario */
            /* Otros estilos, como color, margen, etc., si es necesario */
        }
    </style>
    
    <?php
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    ?>

</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="alumnia.html">ALUMNIA</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->

</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Centro</div>
                    <a class="nav-link collapsed" href="#collapseControl" data-bs-toggle="collapse" data-bs-target="#collapseControl" aria-expanded="false" aria-controls="collapseControl">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Panel de supervisión
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseControl" aria-labelledby="headingControl" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="PanelDeControl.php">Alumnos</a>
                            <a class="nav-link" href="PanelDeControl2.php">Profesores</a>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">Interfaz</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Asistencias
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                Opciones
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/Boostrap/Extras para usar/500.php">Asistencia personalizada</a>
                                    <a class="nav-link" href="/Boostrap//Extras para usar//Promocion.php">Consultar estado académico</a>
                                    <a class="nav-link" href="/Alumno//Asistencia//Asistencia.php">Registro de participación por fecha</a>
                                </nav>
                            </div>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">Complementos</div>
                    <a class="nav-link" href="Tablas.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Manual de usuario
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                    <div class="small">Contacto:</div>
                    facujara1005@gmail.com
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Gestión de Estudiantes</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"></li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-table me-1"></i>Alumnos</span>
                        <button class="btn btn-primary btn-sm" onclick="Scroll()">Agregar Alumno</button>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="table">
                            <thead>
                                <tr>
                                    <th>Documento de identidad</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require '/laragon/www/SistemaAsistencias/ConexionBD/Conexion.php';

                                // Crear una instancia de la clase de conexión a la base de datos
                                $conexionBD = new ConexionBD();
                                $conexion = $conexionBD->getConexion();

                                // Consulta para obtener los datos de los alumnos
                                $sql = "SELECT dni, nombre, apellido, fecha_nacimiento FROM alumnos ORDER BY apellido ASC, nombre ASC;";
                                $result = $conexion->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["dni"] . "</td>";
                                        echo "<td>" . $row["nombre"] . "</td>";
                                        echo "<td>" . $row["apellido"] . "</td>";
                                    
                                        // Extracción del mes y día de nacimiento
                                        $cumpleanos = new DateTime($row["fecha_nacimiento"]);
                                        $mes_cumpleanos = $cumpleanos->format('m');
                                        $dia_cumpleanos = $cumpleanos->format('d');

                                        // Extracción del mes y día actual
                                        $mes_actual = date('m');
                                        $dia_actual = date('d');

                                        // Comparación de mes y día con la fecha actual
                                        if ($mes_cumpleanos == $mes_actual && $dia_cumpleanos == $dia_actual) {
                                            // Muestra el icono de la torta si es el cumpleaños
                                            echo "<td>" . (new DateTime($row["fecha_nacimiento"]))->format('d/m/Y') . "ㅤ 🎂🎈</td>";
                                        } else {
                                            // Muestra la fecha de nacimiento NORMAL
                                            echo "<td>" . (new DateTime($row["fecha_nacimiento"]))->format('d/m/Y') . "</td>";
                                        }
                                    
                                        echo '<td>
                                                <button class="btn btn-danger btn-sm btnEliminar" data-dni="' . $row["dni"] . '" title="Dar de Baja"><i class="fas fa-user-times"></i></button>
                                                <button class="btn btn-primary btn-sm btnEditar edit-button" data-dni="' . $row["dni"] . '" data-nombre="' . $row["nombre"] . '" data-apellido="' . $row["apellido"] . '" data-fecha-nacimiento="' . $row["fecha_nacimiento"] . '" title="Modificar" onclick="abrirFormulario(this); Scroll2();"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-success btn-sm btn-block registrar-asistencia" data-tipo="1" title="Asistió" style="width: 30px;"><i class="fas fa-check"></i></button>
                                            </td>';
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No se encontraron alumnos.</td></tr>";
                                }

                                // Cierra la conexión a la base de datos
                                $conexion->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Formulario para agregar alumno -->
                <div id="formularioAlumno" style="display: none;">
                    <h2>Agregar Alumno</h2>
                    <form id="alumnoForm" method="post" action="/Alumno//Alta//Alta_Alumno.php">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Ingrese el nombre del alumno">
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required placeholder="Ingrese el apellido del alumno">
                        </div>
                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="dni" name="dni" required placeholder="Ingrese el DNI del alumno">
                        </div>
                        <div class="mb-3">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required placeholder="Ingrese la fecha de nacimiento del alumno">
                        </div>
                        <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                    </form>
                </div>


                <!-- Formulario para editar alumno -->
                <div id="formularioAlumno2" style="display: none;">
                    <h2>Modificar datos del alumno</h2>
                    <form id="alumnoForm2" method="post" action="/Alumno//Modificar//Modificar_Alumno.php">
                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="dni" name="dni" required placeholder="Ingrese el DNI del alumno">
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nuevoNombre" name="nombre" required placeholder="Ingrese el nombre del alumno">
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="nuevoApellido" name="apellido" required placeholder="Ingrese el apellido del alumno">
                        </div>
                        <div class="mb-3">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="nuevaFechaDeNacimiento" name="fecha_nacimiento" required placeholder="Ingrese la fecha de nacimiento del alumno">
                        </div>
                        <button type="submit" class="btn btn-primary" id="btnGuardar2">Guardar</button>
                    </form>
                </div>
            
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Alumnia</div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    


// FORMULARIO AGREGAR ALUMNO


function Scroll() {
    const formularioAgregar = document.getElementById('formularioAlumno');
    const formularioEditar = document.getElementById('formularioAlumno2');

    // Ocultar formularios anteriores
    formularioEditar.style.display = 'none';

    // Mostrar el formulario de agregar
    formularioAgregar.style.display = 'block';

    // Agregar alerta de SweetAlert
    Swal.fire({
        title: 'Formulario de Agregar Alumno',
        text: 'Has abierto el formulario para agregar un nuevo alumno.',
        icon: 'info',
        confirmButtonText: 'Entendido'
    }).then(() => {
        // Pequeño retraso antes del desplazamiento
        setTimeout(() => {
            // Desplazar al final de la página después de la alerta
            window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
        }, 200);
    });
}

   // FORMULARIO EDITAR ALUMNO

   function abrirFormulario(button) {
    const formularioEditar = document.getElementById('formularioAlumno2');
    const formularioAgregar = document.getElementById('formularioAlumno');

    // Ocultar formularios anteriores
    formularioAgregar.style.display = 'none';

    // Obtener los datos de la fila
    var dni = button.getAttribute('data-dni');
    var nombre = button.getAttribute('data-nombre');
    var apellido = button.getAttribute('data-apellido');
    var fechaNacimiento = button.getAttribute('data-fecha-nacimiento');

    // Rellenar los campos del formulario de editar
    // document.getElementById('dni').value = dni;
    document.getElementById('nuevoNombre').value = nombre;
    document.getElementById('nuevoApellido').value = apellido;
    document.getElementById('nuevaFechaDeNacimiento').value = fechaNacimiento;

    // Mostrar el formulario de editar
    formularioEditar.style.display = 'block';

    // Agregar alerta de SweetAlert
    Swal.fire({
        title: 'Formulario de Modificar Alumno',
        text: 'Has abierto el formulario para modificar los datos de un alumno existente.',
        icon: 'info',
        confirmButtonText: 'Entendido'
    }).then(() => {
        // Pequeño retraso antes del desplazamiento
        setTimeout(() => {
            // Desplazar al final de la página después de la alerta
            window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
        }, 200);
    });
}



// Manejador de eventos para el botón "Guardar"
$("#btnGuardar").on("click", function (event) {
    // Evitar que el formulario se envíe automáticamente
    event.preventDefault();

    // Utiliza SweetAlert para mostrar la confirmación
    Swal.fire({
        title: "¿Seguro que deseas dar de alta a este alumno?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, dar de alta",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            // Realizar la llamada AJAX para dar de alta al alumno
            $.ajax({
                method: "POST",
                url: "/Alumno/Alta/Alta_Alumno.php",
                data: $("#alumnoForm").serialize(), // Serializar el formulario
                dataType: "json",
                success: function (response) {
                    // Verificar si la respuesta es exitosa
                    if (response.status) {
                        // Después de agregar, mostrar SweetAlert
                        Swal.fire({
                            title: response.message,
                            icon: "success",
                            confirmButtonText: "OK",
                        }).then(() => {
                            // Recargar la página después de hacer clic en OK
                            location.reload();
                        });
                    } else {
                        // Muestra un mensaje de error si success es false
                        Swal.fire({
                            title: "Error",
                            text: response.message.join("<br>"), // Mostrar errores como una lista
                            icon: "error",
                            confirmButtonText: "OK",
                        });
                    }
                },
                error: function (error) {
                    // Manejar errores si es necesario
                    console.error("Error en la llamada AJAX:", error);
                },
            });
        }
    });
});


// Manejador de eventos para el botón "Guardar2"
$("#btnGuardar2").on("click", function (event) {
    // Evitar que el formulario se envíe automáticamente
    event.preventDefault();

    // Utiliza SweetAlert para mostrar la confirmación
    Swal.fire({
        title: "¿Seguro que deseas modificar los datos de este alumno?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, modificar",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            // Realizar la llamada AJAX para modificar al alumno
            $.ajax({
                method: "POST",
                url: "/Alumno/Modificar/Modificar_Alumno.php",
                data: $("#alumnoForm2").serialize(), // Serializar el formulario
                dataType: "json",
                success: function (response) {
                    // Verificar si la respuesta es exitosa
                    if (response.success) {
                        // Después de modificar, mostrar SweetAlert
                        Swal.fire({
                            title: response.message,
                            icon: "success",
                            confirmButtonText: "OK",
                        }).then(() => {
                            // Recargar la página después de hacer clic en OK
                            location.reload();
                        });
                    } else {
                        // Muestra un mensaje de error si success es false
                        Swal.fire({
                            title: "Error",
                            text: response.message.join("<br>"), // Mostrar errores como una lista
                            icon: "error",
                            confirmButtonText: "OK",
                        });
                    }
                },
                error: function (error) {
                    // Manejar errores si es necesario
                    console.error("Error en la llamada AJAX:", error);
                },
            });
        }
    });
});






// Manejador de eventos para el botón "Dar de Baja"
$(".btnEliminar").on("click", function () {
    var dni = $(this).data("dni");
    var fila = $(this).closest("tr");

    // Utiliza SweetAlert para mostrar la confirmación
    Swal.fire({
        title: "¿Seguro que deseas dar de baja a este alumno?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, dar de baja",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "POST",
                url: "/Alumno/Baja/Baja_Alumno.php",
                data: { dni: dni },
                complete: function () {
                    // Después de eliminar, mostrar SweetAlert
                    Swal.fire({
                        title: "Alumno eliminado exitosamente",
                        icon: "success",
                        confirmButtonText: "OK",
                    }).then(() => {
                        // Recargar la página después de hacer clic en OK
                        location.reload();
                    });
                },
            });
        }
    });
});




  $(document).ready(function() {
    $(".registrar-asistencia").on("click", function() {
      var boton = $(this);
      var tipoAsistencia = boton.data("tipo");
      var fila = boton.closest("tr");
      var dni_alumno = fila.find("td:eq(0)").text();

      $.ajax({
        type: "POST",
        url: "/Alumno/Asistencia/RegistrarAsistencia.php",
        data: {
          dni_alumno: dni_alumno,
          tipo_asistencia: tipoAsistencia,
        },
        success: function(response) {
          // Utiliza SweetAlert para mostrar mensajes personalizados
          if (response === "success") {
            Swal.fire("¡Asistencia registrada con éxito!", "", "success");
          } else if (response === "error") {
            Swal.fire("Error al registrar la asistencia.", "", "error");
          } else if (response === "already_exists") {
            Swal.fire("La asistencia ya está registrada en el día de hoy.", "", "warning");
          } else if (response === "data_error") {
            Swal.fire("Error: Datos incorrectos al registrar la asistencia.", "", "error");
          }
        },
      });
    });
  });





</script>
</body>
</html>
