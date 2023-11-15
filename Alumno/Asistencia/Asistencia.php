<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sistemas de Asistencias</title>
    <link href="/Boostrap//css//styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        h1.mt-4 {
            font-size: 27px; /* Ajusta el tamaño de la fuente según tus preferencias */
            font-weight: bold; /* Hace que el texto sea más audaz (serio) */
            font-family: "Arial", sans-serif; /* Cambia la fuente a una más seria si es necesario */
            /* Otros estilos, como color, margen, etc., si es necesario */
        }
    </style>

</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="/Boostrap//Alumnia.html">ALUMNIA</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

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
                            <a class="nav-link" href="/Boostrap//PanelDeControl.php">Alumnos</a>
                            <a class="nav-link" href="/Boostrap//PanelDeControl2.php">Profesores</a>
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
                            <!-- Añadir un div para mostrar los resultados -->
                            <div id="resultadosAsistencia" style="display: none;">
                                <h2>Resultados de Asistencia</h2>
                                <table class="table" id="tablaAsistencias">
                                    <!-- Aquí se mostrarán los resultados -->
                                </table>
                            </div>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">Complementos</div>
                    <a class="nav-link" href="/Boostrap//Tablas.html">
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
                <h1 class="mt-4">Registro de participación por fecha</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"></li>
                </ol>
                <!-- Formulario para editar asistencia -->
                    <div id="formularioAlumno" style="display: block;">
                        <form id="alumnoForm" method="post" action="/Alumno/Asistencia/RegistrarAsistencia.php">
                            <div class="mb-3">
                                <label for="fecha_asistencia" class="form-label">Fecha de la asistencia</label>
                                <input type="date" class="form-control" id="fecha_asistencia" name="fecha_asistencia" required>
                            </div>
                            <button type="submit" class="btn btn-primary" id="btnConsultar">Consultar</button>

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
<script src="/Boostrap//js//scripts.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
 
 $(document).ready(function () {
    // Manejador de eventos para el formulario
    $("#alumnoForm").submit(function (event) {
        // Evitar que el formulario se envíe automáticamente
        event.preventDefault();

        // Obtener la fecha ingresada por el usuario
        var fechaAsistencia = $("#fecha_asistencia").val();

        // Realizar la llamada AJAX para consultar asistencias
        $.ajax({
            method: "POST",
            url: "/Alumno/Asistencia/ConsultarAsistencia.php",
            data: { fecha_asistencia: fechaAsistencia },
            dataType: "json",
            success: function (response) {

                // Verificar si la respuesta es exitosa
                if (response.success) {
                    // Mostrar los resultados en la tabla
                    mostrarResultados(response.data);
                } else {
                    // Mostrar mensaje de error si no hay resultados
                    alert(response.message);
                }
            },
            error: function (error) {
                // Manejar errores si es necesario
                console.error("Error en la llamada AJAX:", error);
            },
        });
    });
});

function mostrarResultados(data) {
    // Verificar si hay asistencias
    if (data.length > 0) {
        // Construir el mensaje con los nombres y apellidos de los alumnos que asistieron
        var mensaje = "Asistieron los siguientes alumnos:\n\n";
        data.forEach(function (alumno) {
            mensaje += "✔"+ alumno.nombre + " " + alumno.apellido + 'ㅤ';
        });

        // Mostrar SweetAlert con los nombres y apellidos de los alumnos que asistieron
        Swal.fire({
            title: 'Asistencias',
            text: mensaje,
            icon: 'success',
            confirmButtonText: 'Cerrar'
        });
    } else {
        // Mostrar SweetAlert indicando que no hay asistencias
        Swal.fire({
            title: 'Sin asistencias',
            text: 'No hay asistencias para la fecha especificada',
            icon: 'info',
            confirmButtonText: 'Cerrar'
        });
    }
}






</script>

</body>
</html>
