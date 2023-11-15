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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <style>
        h1.mt-4 {
            font-size: 27px;
            font-weight: bold;
            font-family: "Arial", sans-serif;
        }

        #formularioAlumno {
            display: block;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="/Boostrap//Alumnia.html">ALUMNIA</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
    
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Centro</div>
                        <a class="nav-link collapsed" href="#collapseControl" data-bs-toggle="collapse"
                            data-bs-target="#collapseControl" aria-expanded="false" aria-controls="collapseControl">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Panel de supervisión
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseControl" aria-labelledby="headingControl"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/Boostrap//PanelDeControl.php">Alumnos</a>
                                <a class="nav-link" href="/Boostrap//PanelDeControl2.php">Profesores</a>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Interfaz</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                            aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Asistencias
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseError" aria-expanded="false"
                                    aria-controls="pagesCollapseError">
                                    Opciones
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link"
                                            href="/Boostrap/Extras para usar/500.php">Asistencia
                                            personalizada</a>
                                        <a class="nav-link"
                                            href="/Boostrap//Extras para usar//Promocion.php">Consultar estado
                                            académico</a>
                                        <a class="nav-link"
                                            href="/Alumno//Asistencia//Asistencia.php">Registro de
                                            participación por fecha</a>
                                    </nav>
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
                    <h1 class="mt-4">Asistencia Personalizada</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"></li>
                    </ol>
                    <!-- Formulario para asistencia EDITADA  -->
                    <div id="formularioAlumno">
                       
                        <form id="alumnoForm" method="post" action="/Alumno/Asistencia/RegistrarAsistenciaPer.php">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del alumno</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required
                                    placeholder="Ingrese el nombre del alumno">
                            </div>
                            <div class="mb-3">
                                <label for="apellido" class="form-label">Apellido del alumno</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" required
                                    placeholder="Ingrese el apellido del alumno">
                            </div>
                            <div class="mb-3">
                                <label for="fecha_asistencia" class="form-label">Fecha de la asistencia</label>
                                <input type="date" class="form-control" id="fecha_asistencia" name="fecha_asistencia"
                                    required placeholder="Ingrese la fecha de asistencia del alumno">
                            </div>
                            <div class="mb-3">
                                <label for="estado_asistencia" class="form-label">Estado de la asistencia</label>
                                <select class="form-select" id="estado_asistencia" name="estado_asistencia" required>
                                    <option value="" disabled selected>Seleccione el estado de asistencia</option>
                                    <option value="asistio">Asistió</option>
                                    <option value="llego_tarde">Llegó tarde</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" id="btnGuardar">Registrar Asistencia</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/Boostrap//js//scripts.js"></script>
    <script>
      

 $(document).ready(function() {
    // Manejador de eventos para el formulario
    $("#alumnoForm").on("submit", function (event) {
        event.preventDefault(); // Prevenir la acción predeterminada del formulario

        Swal.fire({
            title: "¿Seguro que deseas registrar esta asistencia?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, registrar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "POST",
                    url: "/Alumno/Asistencia/RegistrarAsistenciaPer.php",
                    data: $(this).serialize(), // Utilizar $(this) para serializar el formulario actual
                    dataType: "json",
                    success: function (response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                title: response.message,
                                icon: "success",
                                confirmButtonText: "OK",
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: "Error",
                                text: response.message,
                                icon: "error",
                                confirmButtonText: "OK",
                            });
                        }
                    },
                    error: function (error) {
                        console.error("Error en la llamada AJAX:", error);
                    },
                });
            }
        });
    });
});




</script>
</body>

</html>
