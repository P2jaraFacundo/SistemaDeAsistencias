<?php
require_once '/laragon/www/SistemaAsistencias/ConexionBD/Conexion.php'; // Ruta relativa al archivo de conexión

date_default_timezone_set('America/Argentina/Buenos_Aires');

$conexionBD = new ConexionBD();
$conexion = $conexionBD->getConexion();

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si los datos se están enviando correctamente
if (isset($_POST['dni_alumno']) && isset($_POST['tipo_asistencia'])) {
    $dni_alumno = $_POST['dni_alumno'];
    $tipoAsistencia = $_POST['tipo_asistencia'];

    // Define la fecha actual
    $fecha_actual = date('Y-m-d');

    $verificar_asistencia = "SELECT COUNT(*) FROM asistencias WHERE dni_alumno = '$dni_alumno' AND fecha = '$fecha_actual' AND tipo_asistencia = '$tipoAsistencia'";

    $resultado_verificacion = $conexion->query($verificar_asistencia);

    if ($resultado_verificacion) {
        $fila = $resultado_verificacion->fetch_row();
        $existen_asistencias = $fila[0];
        if ($existen_asistencias == 0) {

            $sql = "INSERT INTO asistencias (dni_alumno, id_materia, fecha, tipo_asistencia) 
            VALUES ('$dni_alumno', 1, '$fecha_actual', '$tipoAsistencia')";
    

            if ($conexion->query($sql) === TRUE) {
                echo "success"; // Enviar una respuesta de éxito
            } else {
                echo "error"; // Enviar una respuesta de error
            }
        } else {
            echo "already_exists"; // Enviar una respuesta si la asistencia ya existe
        }
    }

}

$conexion->close();
?>
