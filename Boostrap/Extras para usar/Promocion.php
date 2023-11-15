<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sistemas de Asistencias</title>
    <link href="/Boostrap/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        h1.mt-4 {
            font-size: 27px;
            font-weight: bold;
            font-family: "Arial", sans-serif;
        }

        .promocion {
            color: blue;
            font-weight: bold;
        }

        .regular {
            color: green;
            font-weight: bold;
        }

        .libre {
            color: red;
            font-weight: bold;
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
                <h1 class="mt-4">Estado académico de los estudiantes</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"></li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-table me-2"></i>Alumnos</span>
                        <div id="contadorDias"></div>
                        <div class="d-flex align-items-center">
                            <label for="numeroDiasClase" class="mr-2 font-weight-bold" style="margin-right: 5px;">Jornadas Académicas</label>
                            <input type="number" id="numeroDiasClase" class="form-control form-control-sm" min="0" step="1" style="width: 60px; margin-right: 10px;">
                            <button id="actualizarDias" class="btn btn-sm btn-primary" type="button">Actualizar</button>

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Situación Académica</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                                // Incluye la conexión a la base de datos
                                require '/laragon/www/SistemaAsistencias/ConexionBD/Conexion.php';
                                $conexionBD = new ConexionBD();
                                $conexion = $conexionBD->getConexion();

                                // Comprueba si se recibió el dato de número de días de clase
                                if (isset($_POST['numeroDiasClase'])) {
                                    $clases = $_POST['numeroDiasClase'];
                                    echo "Dato recibido correctamente. Numero de días de clase: $clases";
                                } else {
                                    echo "El número de clases está temporalmente establecido en 3 hasta resolver el problema.";

                                }

                                // Inicializa $clases en caso de que no se haya recibido
                                $clases = isset($_POST['numeroDiasClase']) ? $_POST['numeroDiasClase'] : 3;

                                // Resto de tu código PHP
                                $sql = "SELECT dni, nombre, apellido FROM alumnos ORDER BY apellido ASC, nombre ASC;";
                                $result = $conexion->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $dniAlumno = $row["dni"];
                                        $nombre = $row["nombre"];
                                        $apellido = $row["apellido"];

                                        $sqlAsistencia = "SELECT COUNT(*) as cantidad_dias FROM asistencias WHERE dni_alumno='$dniAlumno' AND tipo_asistencia = 1;";
                                        $resultAsistencia = $conexion->query($sqlAsistencia);

                                        if ($resultAsistencia->num_rows > 0) {
                                            $rowAsistencia = $resultAsistencia->fetch_assoc();
                                            $cantidadDias = $rowAsistencia["cantidad_dias"];
                                            $clases = $clases != 0 ? $clases : 1;
                                            $porcentajeAs = ($cantidadDias / $clases) * 100;

                                            // Define $situacionPromocion según el porcentaje
                                            if ($porcentajeAs >= 80) {
                                                $situacionPromocion = "<span class='promocion'>PROMOCION</span>";
                                            } elseif ($porcentajeAs >= 50 && $porcentajeAs < 80) {
                                                $situacionPromocion = "<span class='regular'>REGULAR</span>";
                                            } else {
                                                $situacionPromocion = "<span class='libre'>LIBRE</span>";
                                            }

                                            // Resto de tu código para mostrar resultados
                                            echo "<tr>";
                                            echo "<td>$nombre</td>";
                                            echo "<td>$apellido</td>";
                                            echo '<td>' . $situacionPromocion .  '</td>';
                                            echo "</tr>";
                                        }
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No se encontraron alumnos.</td></tr>";
                                }

                                $conexion->close();
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Formulario para EDITAR ASISTENCIA -->
                <div id="formularioAlumno" style="display: none;">
                    <h2 class="mt-4">Editar Asistencia</h2>
                    <form id="alumnoForm" method="post" action="../Alumno/Alta/Alta_Alumno.php">
                        <!-- ... (tu código para el formulario) ... -->
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
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="/Boostrap/js/scripts.js"></script>

<script>
    
    var numeroDiasClase = localStorage.getItem('numeroDiasClase') || 0;

    console.log("Enviando número de días de clase:", numeroDiasClase);

function actualizarContadorDias() {
    var contadorDiasElement = document.getElementById("contadorDias");
    if (contadorDiasElement) {
        contadorDiasElement.textContent = "Jornadas académicas: " + numeroDiasClase;
    } else {
        console.error("Elemento con id 'contadorDias' no encontrado.");
    }
}

actualizarContadorDias();

$(document).ready(function () {
    $("#actualizarDias").on("click", function () {
        var inputNumeroDias = document.getElementById("numeroDiasClase");
        numeroDiasClase = parseInt(inputNumeroDias.value) || 0;
        actualizarContadorDias();
        localStorage.setItem('numeroDiasClase', numeroDiasClase);

        // AJAX para enviar el valor al servidor
        $.ajax({
            type: "POST",
            url: "/Boostrap/Extras para usar/Promocion.php", // Cambiado a window.location.pathname
            data: { 'numeroDiasClase': numeroDiasClase },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Días de clase actualizados correctamente',
                }).then(function () {
                    // Recargar la página después de tocar OK en SweetAlert
                    location.reload();
                });
            },
            error: function (error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
    });
});
</script>

</body>
</html>
