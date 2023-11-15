<?php
require_once '/laragon/www/SistemaAsistencias/ConexionBD/Conexion.php'; // Ruta relativa al archivo de conexión

date_default_timezone_set('America/Argentina/Buenos_Aires');

$conexionBD = new ConexionBD();
$conexion = $conexionBD->getConexion();

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// ...

if (
    isset($_POST['nombre']) &&
    isset($_POST['apellido']) &&
    isset($_POST['fecha_asistencia']) &&
    isset($_POST['estado_asistencia'])
) {
    // Recuperar datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_asistencia = $_POST['fecha_asistencia'];
    $estado_asistencia = $_POST['estado_asistencia'];

    // Define la fecha actual
    $fecha_actual = date('Y-m-d');

    // Verificar si la fecha ingresada es mayor o igual a la fecha actual, no es una fecha futura y es en 2023 o posterior
    if ($fecha_asistencia <= $fecha_actual && strtotime($fecha_asistencia) >= strtotime('2023-01-01')) {
        // Buscar el DNI basado en el nombre y el apellido
        $buscar_dni = "SELECT dni FROM alumnos WHERE nombre = '$nombre' AND apellido = '$apellido'";
        $resultado_buscar_dni = $conexion->query($buscar_dni);
        
        if ($resultado_buscar_dni && $fila = $resultado_buscar_dni->fetch_assoc()) {
            $dni_alumno = $fila['dni'];

            // Verificar si ya existe una asistencia para el mismo alumno en la misma fecha y tipo
            $verificar_asistencia = "SELECT COUNT(*) FROM asistencias WHERE dni_alumno = '$dni_alumno' AND fecha = '$fecha_asistencia' AND tipo_asistencia = 1";

            $resultado_verificacion = $conexion->query($verificar_asistencia);

            if ($resultado_verificacion) {
                $fila = $resultado_verificacion->fetch_row();
                $existen_asistencias = $fila[0];

                if ($existen_asistencias == 0) {
                    // Insertar la nueva asistencia si no existe una previa
                    $sql = "INSERT INTO asistencias (dni_alumno, id_materia, fecha, tipo_asistencia) 
                            VALUES ('$dni_alumno', 1, '$fecha_asistencia', 1)";

                    if ($conexion->query($sql) === TRUE) {
                        $response = array('status' => 'success', 'message' => 'La asistencia se registró con éxito');
                        echo json_encode($response);
                    } else {
                        $response = array('status' => 'error', 'message' => 'Hubo un error al registrar la asistencia: ' . $conexion->error);
                        echo json_encode($response);
                    }
                } else {
                    $response = array('status' => 'already_exists', 'message' => 'Ya existe una asistencia para este alumno en la fecha ingresada');
                    echo json_encode($response);
                }
            } else {
                $response = array('status' => 'error', 'message' => 'Hubo un error al verificar la asistencia: ' . $conexion->error);
                echo json_encode($response);
            }
        } else {
            $response = array('status' => 'error', 'message' => 'Hubo un error al buscar al alumno que ingresó' . $conexion->error);
            echo json_encode($response);
        }
    } else {
        $response = array('status' => 'invalid_date', 'message' => 'Por favor, tenga en cuenta que no es posible registrar asistencias para fechas anteriores a 2023. Además, le informamos que tampoco se permite el registro de asistencias para fechas futuras');
        echo json_encode($response);
    }
}

$conexion->close();
?>
